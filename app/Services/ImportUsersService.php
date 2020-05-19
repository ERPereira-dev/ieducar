<?php

namespace App\Services;

use App\Contracts\Output;
use App\Models\LegacyEmployee;
use App\Models\LegacyIndividual;
use App\Models\LegacyInstitution;
use App\Models\LegacyPerson;
use App\Models\LegacyUser;
use App\Models\LegacyUserType;
use App\Support\Database\Connections;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportUsersService implements ToCollection
{
    use Connections;

    /**
     * @var Output
     */
    private $output;

    /**
     * @var bool
     */
    private $forceResetPassword;
    /**
     * @var bool
     */
    private $multiTenant;

    /**
     * @param Output $output
     * @param bool $multiTenant
     * @param bool $forceResetPassword
     */
    public function __construct(Output $output, $multiTenant = false, $forceResetPassword = false)
    {
        $this->output = $output;
        $this->forceResetPassword = $forceResetPassword;
        $this->multiTenant = $multiTenant;
    }

    /**
     * @inheritDoc
     */
    public function collection(Collection $rows)
    {
        $this->output->progressStart($rows->count());

        unset($rows[0]);

        foreach ($rows as $row) {
            $name = $row[0] . ' ' . $row[1];
            $email = $row[2];
            $password = Str::random(8);
            $login = $row[3];

            $this->createUser($name, $login, $password, $email, $this->forceResetPassword);

            $this->sendPasswordEmail($login, $email, $password);

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }

    /**
     * Cria um usuário a partir do nome, matrícula e senha informados
     *
     * @param string $name
     * @param string $user Matrícula
     * @param string $password
     * @param string $email
     * @param bool $forceResetPassword
     * @return
     */
    public function createUser($name, $user, $password, $email, $forceResetPassword)
    {
        if (!$this->multiTenant) {
            return $this->createUserByConnection($name, $user, $password, $email, $forceResetPassword);
        }

        foreach ($this->getConnections() as $connection) {
            $this->createUserByConnection($name, $user, $password, $email, $forceResetPassword, $connection);
        }
    }

    /**
     * @param string $name
     * @param string $user
     * @param string $password
     * @param string $email
     * @param bool $forceResetPassword
     * @param string|null $connection
     * @return LegacyUser|null
     */
    private function createUserByConnection(string $name, string $user, string $password, string $email, bool $forceResetPassword, $connection = null)
    {
        if ($connection) {
            DB::setDefaultConnection($connection);
        }

        if ($this->loginExists($user)){
            $message = sprintf('O usuário %s não pode ser criado a matrícula já está em uso', $user);

            if ($connection) {
                $message .= ' - ' . $connection;
            }

            $this->output->info($message);
            return;
        }

        $person = LegacyPerson::create([
            'nome' => $name,
            'tipo' => 'F',
            'email' => $email,
        ]);

        $individual = LegacyIndividual::create([
            'idpes' => $person->getKey(),
        ]);

        $employee = LegacyEmployee::create([
            'ref_cod_pessoa_fj' => $individual->getKey(),
            'matricula' => $user,
            'senha' => $password,
            'ativo' => 1,
            'force_reset_password' => $forceResetPassword,
            'email' => $email,
        ]);

        return LegacyUser::create([
            'cod_usuario' => $employee->getKey(),
            'ref_cod_instituicao' => app(LegacyInstitution::class)->getKey(),
            'ref_funcionario_cad' => 1,
            'ref_cod_tipo_usuario' => LegacyUserType::LEVEL_ADMIN,
            'data_cadastro' => now(),
            'ativo' => 1,
        ]);
    }

    private function loginExists(string $user)
    {
        return LegacyEmployee::where('matricula', $user)->exists();
    }

    /**
     * Envia um email informando a senha do usuário
     *
     * @param $login
     * @param string $email
     * @param string $password
     */
    public function sendPasswordEmail($login, $email, $password)
    {
        $url = [];
        if (!$this->multiTenant) {
            $url = config('app.url');
        }

        Mail::send(new NewUserMail($login, $email, $password, $url));
    }
}

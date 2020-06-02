<?php

namespace App\Services\Educacenso\Version2020;

use App\Models\Educacenso\RegistroEducacenso;
use App\Models\LegacySchool;
use App\Models\SchoolInep;
use App\Services\Educacenso\Version2019\Registro10Import as Registro10Import2019;

class Registro10Import extends Registro10Import2019
{
    /**
     * Faz a importação dos dados a partir da linha do arquivo
     *
     * @param RegistroEducacenso $model
     * @param int $year
     * @param $user
     * @return void
     */
    public function import(RegistroEducacenso $model, $year, $user)
    {
        self::import($model, $year, $user);

        $schoolInep = $this->getSchool();

        if (empty($schoolInep)) {
            return;
        }

        /** @var LegacySchool $school */
        $school = $schoolInep->school;
        $model = $this->model;

        $school->qtd_vice_diretor = $model->qtdViceDiretor ?: null;
        $school->qtd_orientador_comunitario = $model->qtdOrientadorComunitario ?: null;

        $school->save();
    }

    private function getSchool()
    {
        return SchoolInep::where('cod_escola_inep', $this->model->codigoInep)->first();
    }

}

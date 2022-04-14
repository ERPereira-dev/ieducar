<?php

namespace Database\Factories;

use App\Models\LegacyRegimeType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegacyRegimeTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LegacyRegimeType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'ref_usuario_cad' => 1,
            'nm_tipo' => $this->faker->words(3, true),
            'data_cadastro' => now(),
            'ativo' => 1,
            'ref_cod_instituicao' => LegacyInstitutionFactory::new()->unique()->make(),
        ];
    }
}

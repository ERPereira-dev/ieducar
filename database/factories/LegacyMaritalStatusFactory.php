<?php

namespace Database\Factories;

use App\Models\LegacyMaritalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegacyMaritalStatusFactory extends Factory
{
    protected $model = LegacyMaritalStatus::class;

    public function definition(): array
    {
        return [
            'descricao' => $this->faker->unique()->word,
        ];
    }

    public function current(): LegacyMaritalStatus
    {
        $data = [
            'ideciv' => 1,
            'descricao' => 'Solteiro(a)',
        ];

        return LegacyMaritalStatus::query()->where($data)->first() ?? $this->create($data);
    }
}

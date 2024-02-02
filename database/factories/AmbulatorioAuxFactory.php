<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AmbulatorioAux>
 */
class AmbulatorioAuxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grupo' => fake()->word(3),
            'descricao' => fake()->paragraph(1),
            'disponivel' => true,
            'user_id' => 1,
        ];
    }
}

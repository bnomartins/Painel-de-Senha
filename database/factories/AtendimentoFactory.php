<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atendimento>
 */
class AtendimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'senha' => fake()->word(1),
            'status' => fake()->numberBetween(11111111111,99999999999),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'paciente_id' => function () {
                return \App\Models\Paciente::factory()->create()->id;
            }

        ];
    }
}

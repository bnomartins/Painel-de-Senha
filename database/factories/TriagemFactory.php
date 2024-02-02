<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Triagem>
 */
class TriagemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classificacao' => fake()->word(1),
            'observacao' => fake()->word(5),
            'queixa' => fake()->word(2),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'atendimento_id' => function () {
                return \App\Models\Atendimento::factory()->create()->id;
            },
            'risco_id' => function () {
                return \App\Models\Risco::factory()->create()->id;
            }
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exame>
 */
class ExameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resultado' => fake()->word(1),
            'observacao' => fake()->paragraph(),

            // 'user_id' => function () {
            //     return \App\Models\User::factory()->create()->id;
            // },
            'clinico_id' => function () {
                return \App\Models\Clinico::factory()->create()->id;
            },
            'solicitacao_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'procedimento_id' => function () {
                return \App\Models\Procedimento::factory()->create()->id;
            },
        ];
    }
}

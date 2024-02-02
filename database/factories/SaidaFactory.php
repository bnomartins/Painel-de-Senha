<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saida>
 */
class SaidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'setor' => true,
            'setor_id' => function () {
                return \App\Models\Setor::factory()->create()->id;
            },
            'solicitacao_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'liberacao_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },

            'observacao' => fake()->paragraph(1)

        ];
    }
}

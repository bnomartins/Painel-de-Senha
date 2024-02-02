<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelProcAtend>
 */
class RelProcAtendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_solicitacao_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'user_atendimento_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'atendimento_id' => function () {
                return \App\Models\Atendimento::factory()->create()->id;
            },
            'procedimento' => fake()->word(3),
            'descricao' => fake()->paragraph(1),
            'procedimento' => fake()->word(3),

            'local_origem' => fake()->word(3),
            'local_atendimento' => fake()->word(3),

            'servico_origem' => fake()->word(3),
            'servico_destino' => fake()->word(3),
        ];
    }
}

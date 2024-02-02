<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IdentificacaoEstoque>
 */
class IdentificacaoEstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identificacao' => fake()->word(1),
            'descricao' => fake()->paragraph(1)
            ,'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }
        ];
    }
}

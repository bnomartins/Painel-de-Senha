<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Procedimento>
 */
class ProcedimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'procedimento' => fake()->word(3),
            'codigo' => fake()->word(1),
            'descricao' => fake()->paragraph(1),
            'disponivel' => true,
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },        
        ];
    }
}

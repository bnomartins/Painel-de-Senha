<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cbo>
 */
class CboFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cbo' => fake()->word(1),
            'descricao' => fake()->paragraph(2),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },        
        ];
    }
}

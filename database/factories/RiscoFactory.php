<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Riscos>
 */
class RiscoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classificacao' => fake()->word(3),
            'discriminacao' => fake()->paragraph(1),
            'observacao' => fake()->paragraph(1),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },        
        ];
    }
}

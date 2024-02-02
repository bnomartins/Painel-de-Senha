<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cid2>
 */
class Cid2Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cid' => fake()->word(1),
            'procedimento' => fake()->word(4),
            'descricao' => fake()->paragraph(2),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },  
        ];
    }
}

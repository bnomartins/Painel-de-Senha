<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicamentos>
 */
class MedicamentosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descricao' => fake()->paragraph(),

            // 'user_id' => function () {
            //     return \App\Models\User::factory()->create()->id;
            // },
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
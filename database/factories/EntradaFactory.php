<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrada>
 */
class EntradaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'documento_tipo' => fake()->word(1),
            'valor_total' => 1055,
            'user_id' => function(){
                return \App\Models\User::factory()->create()->id;
            },
            'fornecedor_id' => function(){
                return \App\Models\Fornecedor::factory()->create()->id;
            }


        ];
    }
}

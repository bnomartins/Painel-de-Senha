<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntradaAux>
 */
class EntradaAuxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lote' => fake()->word(1),
            'validade' => fake()->date('Y-m-d'),
            'quantidade' => fake()->numberBetween(2,100),
            'valor_unitario' => fake()->numberBetween(2,100),
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }
            ,'estoque_id' => function () {
                return \App\Models\Estoque::factory()->create()->id;
            }
            ,'fornecedor_id' => function () {
                return \App\Models\Fornecedor::factory()->create()->id;
            }
            ,'entrada_id' => function () {
                return \App\Models\Entrada::factory()->create()->id;
            },
        ];
    }
}

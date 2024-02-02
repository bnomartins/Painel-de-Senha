<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemSaida>
 */
class ItemSaidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'saida_id' => function () {
                return \App\Models\Saida::factory()->create()->id;
            },
            'quantidade' => 100,
            'estoque_id' => function(){
                return \App\Models\Estoque::factory()->create()->id;
            }
        ];
    }
}

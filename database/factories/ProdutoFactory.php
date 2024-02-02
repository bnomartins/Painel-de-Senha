<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'foto' => fake()->imageUrl(640, 480, 'animals', true), 
            'produto' => fake()->word(1), 
            'codigo_barra' => fake()->word(1), 
            'descricao_resumida' => fake()->paragraph(1), 
            'descricao_detalhada' => fake()->paragraph(1), 
            'composicao' => fake()->word(2), 
            'especie' => fake()->word(1), 
            'unidade' => fake()->word(2), 
            'validade' => fake()->date(), 
            'especificacao' => fake()->paragraph(1) 
            ,'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }

        ];
    }
}

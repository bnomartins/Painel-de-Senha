<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estoque>
 */
class EstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantidade' => 1000,
            'quantidade_limite' => 100,
            'lote' => 'aaab',
            'valor_unitario' => 10.2
            ,'identificacao_estoque_id' => function () {
                return \App\Models\IdentificacaoEstoque::factory()->create()->id;
            }
            ,'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }
            ,'produto_id' => function () {
                return \App\Models\Produto::factory()->create()->id;
            },

        ];
    }
}

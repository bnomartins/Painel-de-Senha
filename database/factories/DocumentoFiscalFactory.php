<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentoFiscal>
 */
class DocumentoFiscalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nota_numero' => 100,
            'nota_serie' => 150,
            'fornecedor_id' => function(){
                return \App\Models\Fornecedor::factory()->create()->id;
            },
            'user_id' => function(){
                return \App\Models\User::factory()->create()->id;
            }
        ];
    }
}

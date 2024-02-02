<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documento>
 */
class DocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo' => fake()->word(1),
            'titulo' => fake()->word(1),
            'conteudo' => fake()->paragraph(2),
            'documento_modelo_id' => function () {
                return \App\Models\DocumentoModelo::factory()->create()->id;
            },
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'clinico_id' => function () {
                return \App\Models\Clinico::factory()->create()->id;
            },
            'observacao' => fake()->paragraph(2),
        ];
    }
}
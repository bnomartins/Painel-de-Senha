<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelEstUser>
 */
class RelEstUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function(){
                return \App\Models\User::factory()->create();
            },
            'usuario_id' => function(){
                return \App\Models\User::factory()->create();
            },
            'identificacao_estoque_id' => function(){
                return \App\Models\IdentificacaoEstoque::factory()->create();
            },
            'acesso' => fake()->word(1)
        ];
    }
}

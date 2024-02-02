<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelUnidServ>
 */
class RelUnidServFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'unidade_id' => function () {
                return \App\Models\Unidade::factory()->create()->id;
            },
            'servico_id' => function () {
                return \App\Models\Servico::factory()->create()->id;
            },
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            }
        ];
    }
}

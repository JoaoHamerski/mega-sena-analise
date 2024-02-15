<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'concurso' => 1,
            'data' => '2022-01-01',
            'bola_01' => 1,
            'bola_02' => 2,
            'bola_03' => 3,
            'bola_04' => 4,
            'bola_05' => 5,
            'bola_06' => 6,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Progetto;
use App\Models\Ricercatore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class MovimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'importo' => $this->faker->randomFloat(0, -500, -1),
            'causale' => $this->faker->sentence,
            'data' => $this->faker->dateTimeBetween('now', '1 year')->format('Y-m-d'),
            'approvazione' => 0,
            'progetto_id' => function () {
                return Progetto::factory()->create()->id;
            },
            'utente_id' => function () {
                return Ricercatore::factory()->create()->id;
            },
        ];
    }
}

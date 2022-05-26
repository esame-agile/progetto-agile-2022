<?php

namespace Database\Factories;

use App\Models\Progetto;
use App\Models\Responsabile;
use App\Models\Ricercatore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SottoProgetto>
 */
class SottoProgettoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titolo' => $this->faker->sentence(true),
            'descrizione' => $this->faker->sentence(true),
            'data_rilascio' => $this->faker->dateTimeBetween(now(), '+1 month')->format('Y-m-d'),
            'responsabile_id' => function () {
                return Ricercatore::factory()->create()->id;
            },
            'progetto_id' => function () {
                return Progetto::factory()->create()->id;
            },
        ];
    }
}

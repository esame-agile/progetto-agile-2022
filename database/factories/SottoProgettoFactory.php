<?php

namespace Database\Factories;

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
            'titolo' => $this->faker->sentence,
            'descrizione' => $this->faker->paragraph,
            'data_rilascio' => $this->faker->dateTimeBetween(now(), '+1 month')->format('Y-m-d'),
            'responsabile_id' => function () {
                return ResponsabileFactory::new()->create()->id;
            },
            'progetto_id' => function () {
                return ProgettoFactory::new()->create()->id;
            },
        ];
    }
}

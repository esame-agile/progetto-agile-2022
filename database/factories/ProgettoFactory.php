<?php

namespace Database\Factories;

use App\Models\Responsabile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progetto>
 */
class ProgettoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titolo' => $this->faker->city(),
            'descrizione' => $this->faker->sentence(),
            'scopo' => $this->faker->sentence(),
            'data_inizio' => now()->format('Y-m-d'),
            'data_fine' => $this->faker->dateTimeBetween($startDate = now(), $endDate = '+1 years')->format('Y-m-d'),
            'responsabile_id' => function () {
                return Responsabile::factory()->create()->id;
            },
        ];
    }
}

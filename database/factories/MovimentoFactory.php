<?php

namespace Database\Factories;

use App\Models\Progetto;
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
            'importo' => $this->faker->randomFloat(0, 1, 500),
            'causale' => $this->faker->sentence,
            'data' => $this->faker->dateTimeBetween('now', '1 year')->format('Y-m-d'),
            'approvazione' => 0,
            'progetto_id' => Progetto::factory()->create()->id,
        ];
    }
}

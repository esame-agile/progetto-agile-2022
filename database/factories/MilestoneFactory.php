<?php

namespace Database\Factories;

use App\Models\SottoProgetto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Milestone>
 */
class MilestoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'data_evento' => $this->faker->date(),
            'descrizione' => $this->faker->sentence(),
            'sotto_progetto_id' => function () {
                return SottoProgetto::factory()->create()->id;
            },
        ];
    }
}

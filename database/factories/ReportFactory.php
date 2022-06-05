<?php

namespace Database\Factories;

use App\Models\Progetto;
use App\Models\Ricercatore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //TODO: Implement pdf upload and download
        return [
            'titolo' => $this->faker->sentence,
            'file_name' => '123456.pdf',
            'data' => date('Y-m-d'),
            'progetto_id' => Progetto::factory()->create()->id,
            'ricercatore_id' => Ricercatore::factory()->create()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Progetto;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Enum\TipologiaEnum;
use \App\Enum\SorgenteEnum;
use Illuminate\Support\Arr;

/**
 * @extends Factory
 */
class PubblicazioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'doi' => $this->faker->unique()->regexify('[0-9]{8}'),
            'titolo' => $this->faker->title,
            'sorgente' => SorgenteEnum::MANUALE,
            'file_name' => $this->faker->sentence,
            'ufficiale' => $this->faker->boolean,
            'tipologia' => Arr::random(TipologiaEnum::getTipologiaEnum()),
            'autori_esterni' => $this->faker->name.', '.$this->faker->name,
            'progetto_id' => function () {
                return Progetto::factory()->create()->id;
            },
        ];
    }
}

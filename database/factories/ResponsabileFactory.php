<?php

namespace Database\Factories;


use App\Models\Responsabile;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Responsabile>
 */
class ResponsabileFactory extends UtenteFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Responsabile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return array_merge(Parent::definition(),
            ['ruolo' => 'responsabile',
                'data_nascita' => $this->faker->date(),
                'universita' => $this->faker->company,
                'ambito_ricerca' => $this->faker->sentence,
            ]);

    }
}

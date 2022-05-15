<?php

namespace Database\Factories;


use App\Models\Ricercatore;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Ricercatore>
 */
class RicercatoreFactory extends UtenteFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ricercatore::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return array_merge(Parent::definition(),
            ['ruolo' => 'ricercatore',
                'data_nascita' => $this->faker->date(),
                'universita' => $this->faker->company,
                'ambito_ricerca' => $this->faker->sentence,
            ]);

    }
}

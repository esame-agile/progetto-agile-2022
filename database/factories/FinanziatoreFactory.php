<?php

namespace Database\Factories;


use App\Models\Finanziatore;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Finanziatore>
 */
class FinanziatoreFactory extends UtenteFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Finanziatore::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return array_merge(Parent::definition(),
            ['ruolo' => 'Finanziatore',
                'nome_azienda' => $this->faker->company(),
            ]);

    }
}

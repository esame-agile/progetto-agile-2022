<?php

namespace Database\Factories;


use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Manager>
 */
class ManagerFactory extends UtenteFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Manager::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return array_merge(Parent::definition(),
            ['ruolo' => 'manager']);

    }
}

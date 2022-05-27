<?php

namespace Database\Seeders;

use App\Models\Finanziatore;
use App\Models\Manager;
use App\Models\Progetto;
use App\Models\Ricercatore;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Manager::factory(10)->create();
        $manager = Manager::first();
        echo "MANAGER: \n";
        echo "email: " . $manager->email . "\n" . "password: password" . "\n";

        Ricercatore::factory(10)->create();
        $ricercatore = Ricercatore::first();
        $ricercatore->progetti()->saveMany(Progetto::factory(10)->create());
        $progetto= $ricercatore->progetti()->first();
        $progetto->responsabile()->associate($ricercatore);
        $progetto->save();
        echo "RICERCATORE: \n";
        echo "email: " . $ricercatore->email . "\n" . "password: password" . "\n";

        Finanziatore::factory(10)->create();
        $finanziatore = Finanziatore::first();
        echo "FINANZIATORE: \n";
        echo "email: " . $finanziatore->email . "\n" . "password: password" . "\n";


    }
}

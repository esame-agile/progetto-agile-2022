<?php

namespace Database\Seeders;

use App\Models\Finanziatore;
use App\Models\Manager;
use App\Models\Ricercatore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        echo "RICERCATORE: \n";
        echo "email: " . $ricercatore->email . "\n" . "password: password" . "\n";

        Finanziatore::factory(10)->create();
        $finanziatore = Finanziatore::first();
        echo "FINANZIATORE: \n";
        echo "email: " . $finanziatore->email . "\n" . "password: password" . "\n";
    }
}

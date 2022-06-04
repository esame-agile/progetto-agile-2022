<?php

namespace Database\Seeders;

use App\Models\Finanziatore;
use App\Models\Manager;
use App\Models\Milestone;
use App\Models\Movimento;
use App\Models\Progetto;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
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
        Manager::factory(12)->create();
        $manager = Manager::first();
        echo "MANAGER: \n";
        echo "email: " . $manager->email . "\n" . "password: password" . "\n";
        echo "------------------------------------------------------\n";
        Ricercatore::factory(1)->create();
        $ricercatore = Ricercatore::first();
        $ricercatore->progetti()->saveMany(Progetto::factory(12)->create());
        $progetto = $ricercatore->progetti()->first();
        $progetto->responsabile()->associate($ricercatore);
        $progetto->movimenti()->saveMany(Movimento::factory(5)->create());
        $progetto->save();
        echo "RICERCATORE: \n";
        echo "email: " . $ricercatore->email . "\n" . "password: password" . "\n";
        echo "------------------------------------------------------\n";
        SottoProgetto::factory(12)->create()->each(function ($sottoProgetto) {
            $ricercatore = Ricercatore::first();
            $progetto = $ricercatore->progetti()->first();
            $sottoProgetto->responsabile()->associate($ricercatore);
            $sottoProgetto->progetto()->associate($progetto);
            $sottoProgetto->ricercatori()->attach($ricercatore);
            $sottoProgetto->ricercatori()->saveMany(Ricercatore::factory(2)->create());
            $sottoProgetto->milestones()->saveMany(Milestone::factory(12)->create());
        });
        Finanziatore::factory(12)->create();
        $finanziatore = Finanziatore::first();
        echo "FINANZIATORE: \n";
        echo "email: " . $finanziatore->email . "\n" . "password: password" . "\n";
        echo "------------------------------------------------------\n";

    }
}

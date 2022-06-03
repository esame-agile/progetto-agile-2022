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

        Ricercatore::factory(12)->create();
        $ricercatore = Ricercatore::first();
        $ricercatore->progetti()->saveMany(Progetto::factory(12)->create());
        $progetto= $ricercatore->progetti()->first();
        $progetto->responsabile()->associate($ricercatore);
        $progetto->movimenti()->saveMany(Movimento::factory(5)->create());
        $progetto->save();
        echo "RICERCATORE: \n";
        echo "email: " . $ricercatore->email . "\n" . "password: password" . "\n";

        SottoProgetto::factory(12)->create([
            'responsabile_id' => $ricercatore->id,
            'progetto_id' => $progetto->id,
        ]);
        Milestone::factory(12)->create([
            'sotto_progetto_id' => $progetto->sotto_progetti()->first()->id,
        ]);

        Finanziatore::factory(12)->create();
        $finanziatore = Finanziatore::first();
        echo "FINANZIATORE: \n";
        echo "email: " . $finanziatore->email . "\n" . "password: password" . "\n";


    }
}

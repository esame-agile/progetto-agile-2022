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
        $ricercatore = Ricercatore::factory()->create([
            'pid' => '0001',
            'nome' => 'Michele',
            'cognome' => 'Tucci',
            'email' => 'michele.tucci0001@example.com',
            'data_nascita' => date('y-m-d'),
            'universita' => 'Università degli Studi dell\'Aquila',
            'ambito_ricerca' => 'Information Engineering, Computer Science and Mathematics',

        ]);
        $ricercatore->progetti()->saveMany(Progetto::factory(12)->create());
        $progetto = $ricercatore->progetti()->first();
        $progetto->responsabile()->associate($ricercatore);
        $progetto->movimenti()->saveMany(Movimento::factory(5)->create());
        $progetto->finanziatori()->saveMany(Finanziatore::factory(2)->create());
        $progetto->save();
        $ricercatore->sotto_progetti()->saveMany(SottoProgetto::factory(12)->create());
        $sottoProgetto = $ricercatore->sotto_progetti()->first();
        $sottoProgetto->responsabile()->associate($ricercatore);
        $sottoProgetto->ricercatori()->saveMany(Ricercatore::factory(2)->create());
        $sottoProgetto->milestones()->saveMany(Milestone::factory(3)->create());
        $sottoProgetto->save();
        echo "RICERCATORE: \n";
        echo "email: " . $ricercatore->email . "\n" . "password: password" . "\n";
        echo "------------------------------------------------------\n";
        $finanziatore = Finanziatore::first();
        echo "FINANZIATORE: \n";
        echo "email: " . $finanziatore->email . "\n" . "password: password" . "\n";
        echo "------------------------------------------------------\n";

    }
}

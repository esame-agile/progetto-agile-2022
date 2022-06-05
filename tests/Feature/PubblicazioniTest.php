<?php

namespace Tests\Feature;

use App\Models\Progetto;
use App\Models\Pubblicazione;
use App\Models\Ricercatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PubblicazioniTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Viste per le pubblicazioni guest.
     *
     * @return void
     */
    public function test_caricamento_views_pubblicazioni(): void
    {
        $pubblicazione = Pubblicazione::factory()->create();
        $this->get('/pubblicazione/show/' . $pubblicazione->id)->assertStatus(200);
    }

    /**
     * Viste per le pubblicazioni ricercatore
     *
     * @return void
     */
    public function test_caricamento_views_pubblicazioni_ricercatore(): void
    {
        $user = Ricercatore::factory()->create();
        $pubblicazione = Pubblicazione::factory()->create();

        $this->actingAs($user)
            ->get('/pubblicazione/show/' . $pubblicazione->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/pubblicazione/create')
            ->assertStatus(200);
    }

    /**
     * Il responsabile di un progetto può modificare le pubblicazioni del suo progetto.
     *
     * @return void
     */
    public function test_responsabile_puo_modificare_visibilita_pubblicazioni_del_suo_progetto(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $pubblicazione = Pubblicazione::factory()->create([
            'ufficiale' => false,
        ]);
        $pubblicazione->progetto()->associate($progetto);
        $pubblicazione->save();

        $this->actingAs($user)
            ->put('/pubblicazione/update/' . $pubblicazione->id, [
                'visibilita' => 1,
            ])
            ->assertStatus(302);
        $pubblicazione = Pubblicazione::find($pubblicazione->id);
        $this->assertEquals(true, $pubblicazione->ufficiale);
    }

    /**
     * Il ricercatore può eliminare una pubblicazione.
     *
     * @return void
     */
    public function test_ricercatore_puo_eliminare_pubblicazione(): void
    {
        $user = Ricercatore::factory()->create();
        $pubblicazione = Pubblicazione::factory()->create();

        $this->actingAs($user)
            ->delete('/pubblicazione/destroy/' . $pubblicazione->id)
            ->assertStatus(302);

        $this->assertCount(0, Pubblicazione::all());
    }
}

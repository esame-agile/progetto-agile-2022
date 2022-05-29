<?php

namespace Tests\Feature;
use App\Models\Manager;
use App\Models\Progetto;
use App\Models\Pubblicazione;
use App\Models\Ricercatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;

class PubblicazioniTest extends TestCase
{
    use RefreshDatabase;


    public function test_caricamento_views_pubblicazioni_ricercatore()
    {
        $user = Ricercatore::factory()->create();

        $this->actingAs($user)
            ->get('/pubblicazioni/create/' . $user->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/pubblicazioni/edit/' . $user->id)
            ->assertStatus(200);
    }
   public function test_ricercatore_puo_creare_pubblicazione()
    {
        $user = Ricercatore::factory()->create();
        $pubblicazione = Pubblicazione::factory()->make();
        $ricercatori=Ricercatore::factory(5)->create();
        $ricercatori_id=$ricercatori->pluck('id');
        $progetto=Progetto::factory()->create();
        $this->actingAs($user)
            ->post('/pubblicazioni/store', [
                'doi' => $pubblicazione->doi,
                'titolo' => $pubblicazione->titolo,
                'autori_esterni' => $pubblicazione->autori_esterni,
                'tipologia' => $pubblicazione->tipologia,
                'progetto_id' => $progetto->id,
                'ricercatori'=>$ricercatori_id,


            ])
            ->assertStatus(302);
        $this->assertCount(1, Pubblicazione::all());
    }
    public function test_ricercatore_puo_modificare_visibilita_pubblicazioni()
    {
        $user = Ricercatore::factory()->create();
        $pubblicazioniT=Pubblicazione::factory(5)->create();
        $pubblicazioniT_id=$pubblicazioniT->pluck('id');
        $pubblicazioniF=Pubblicazione::factory(5)->create();
        $pubblicazioniF_id=$pubblicazioniF->pluck('id');
        $this->actingAs($user)
            ->put('/pubblicazioni/update', [
                'pubblicazioneiT'=>$pubblicazioniT_id,
                'pubblicazioneiF'=>$pubblicazioniF_id,
            ])
            ->assertStatus(302);
    }
    public function test_ricercatore_puo_eliminare_pubblicazione()
    {
        $user = Ricercatore::factory()->create();
        $pubblicazione = Pubblicazione::factory()->create();

        $this->actingAs($user)
            ->delete('/pubblicazioni/destroy/' . $pubblicazione->id)
            ->assertStatus(302);

        $this->assertCount(0, Pubblicazione::all());
    }
}

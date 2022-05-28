<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SottoProgettoTest extends TestCase
{
    use RefreshDatabase;
    public function test_caricamento_views_sottoprogetti_responsabile()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
//        $this->actingAs($user)
//            ->get('/sotto-progetto/index')
//            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sotto-progetto/show/' . $sottoProgetto->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sotto-progetto/'. $sottoProgetto->id .'/edit-ricercatori')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sotto-progetto/'. $sottoProgetto->id .'/add-ricercatore')
            ->assertStatus(200);
    }

    public function test_caricamento_views_sottoprogetti_manager()
    {
        $user = Manager::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
//        $this->actingAs($user)
//            ->get('/sotto-progetto/index')
//            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sotto-progetto/show/' . $sottoProgetto->id)
            ->assertStatus(200);
    }

    public function test_caricamento_views_sottoprogetti_ricercatore()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
//        $this->actingAs($user)
//            ->get('/sotto-progetto/index')
//            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sotto-progetto/show/' . $sottoProgetto->id)
            ->assertStatus(200);
    }

    public function test_manager_puo_creare_sotto_progetto()
    {
        $user = Manager::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->make();
        $this->actingAs($user)
            ->post('/sotto-progetto/store', [
                'titolo' => $sottoProgetto->titolo,
                'descrizione' => $sottoProgetto->descrizione,
                'data_rilascio' => $sottoProgetto->data_rilascio,
                'responsabile_id' => $sottoProgetto->responsabile_id,
                'progetto_id' => $sottoProgetto->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertCount(1, SottoProgetto::all());
    }

    public function test_manager_puo_modificare_sotto_progetto()
    {
        $user = Manager::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->put('/sotto-progetto/update/' . $sottoProgetto->id, [
                'titolo' => $sottoProgetto->titolo,
                'descrizione' => $sottoProgetto->descrizione,
                'data_rilascio' => $sottoProgetto->data_rilascio,
                'responsabile_id' => $sottoProgetto->responsabile_id,
                'progetto_id' => $sottoProgetto->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertEquals($sottoProgetto->titolo, SottoProgetto::first()->titolo);
    }

    public function test_manager_puo_eliminare_sotto_progetto()
    {
        $user = Manager::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->delete('/sotto-progetto/destroy/' . $sottoProgetto->id)
                ->assertStatus(302);
        $this->assertCount(0, SottoProgetto::all());
    }

    public function test_utente_non_autorizzato_non_puo_creare_sotto_progetto()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->make();
        $this->actingAs($user)
            ->post('/sotto-progetto/store/', [
                'titolo' => $sottoProgetto->titolo,
                'descrizione' => $sottoProgetto->descrizione,
                'data_rilascio' => $sottoProgetto->data_rilascio,
                'responsabile_id' => $sottoProgetto->responsabile_id,
                'progetto_id' => $sottoProgetto->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertCount(0, SottoProgetto::all());
    }

    public function test_utente_non_autorizzato_non_puo_modificare_sotto_progetto()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $sottoProgetto2 = SottoProgetto::factory()->make();
        $this->actingAs($user)
            ->put('/sotto-progetto/update/' . $sottoProgetto->id, [
                'titolo' => $sottoProgetto2->titolo,
                'descrizione' => $sottoProgetto2->descrizione,
                'data_rilascio' => $sottoProgetto2->data_rilascio,
                'responsabile_id' => $sottoProgetto2->responsabile_id,
                'progetto_id' => $sottoProgetto2->progetto_id,
            ])
            ->assertStatus(302);

        $this->assertNotEquals($sottoProgetto2->titolo, SottoProgetto::first()->titolo);
    }

    public function test_utente_non_autorizzato_non_puo_eliminare_sotto_progetto()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->delete('/sotto-progetto/destroy/' . $sottoProgetto->id)
                ->assertStatus(302);
        $this->assertCount(1, SottoProgetto::all());
    }

    public function test_responsabile_puo_aggiungere_ricercatore()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $user2 = Ricercatore::factory()->create();
        $this->actingAs($user)
            ->post('/sotto-progetto/' . $sottoProgetto->id . '/store-ricercatore', [
                'ricercatore_id' => $user2->id
            ])
            ->assertStatus(302);
        $this->assertCount(1, $sottoProgetto->ricercatori);
    }

    public function test_responsabile_puo_eliminare_ricercatore()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $user2 = Ricercatore::factory()->create();
        $sottoProgetto->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/sotto-progetto/' . $sottoProgetto->id . '/remove-ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(0, $sottoProgetto->ricercatori);
    }

    public function test_responsabile_non_puo_eliminare_ricercatore_se_non_autorizzato()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $user2 = Ricercatore::factory()->create();
        $sottoProgetto->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/sotto-progetto/' . $sottoProgetto->id . '/remove-ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(1, $sottoProgetto->ricercatori);
    }
    public function test_utente_non_responsabile_non_puo_eliminare_ricercatore()
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $user2 = Ricercatore::factory()->create();
        $sottoProgetto->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/sotto-progetto/' . $sottoProgetto->id . '/remove-ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(1, $sottoProgetto->ricercatori);
    }



}

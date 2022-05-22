<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Progetto;
use App\Models\Responsabile;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SottoProgettiTest extends TestCase
{
    use RefreshDatabase;
    public function test_caricamento_views_sottoprogetti_responsabile()
    {
        $user = Responsabile::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sottoprogetti')
            ->assertStatus(200);
    }

    public function test_caricamento_views_sottoprogetti_manager()
    {
        $user = Manager::factory()->create();
        $project = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id . '/edit')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sottoprogetti/create')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sottoprogetti')
            ->assertStatus(200);
    }

    public function test_caricamento_views_sottoprogetti_ricercatore()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sottoprogetti')
            ->assertStatus(200);
    }

    public function test_manager_puo_creare_sottoprogetto()
    {
        $user = Manager::factory()->create();
        $project = SottoProgetto::factory()->make();
        $this->actingAs($user)
            ->post('/sottoprogetti', [
                'titolo' => $project->titolo,
                'descrizione' => $project->descrizione,
                'data_rilascio' => $project->data_rilascio,
                'responsabile_id' => $project->responsabile_id,
                'progetto_id' => $project->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertCount(1, SottoProgetto::all());
    }

    public function test_manager_puo_modificare_sottoprogetto()
    {
        $user = Manager::factory()->create();
        $project = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->put('/sottoprogetti/' . $project->id, [
                'titolo' => $project->titolo,
                'descrizione' => $project->descrizione,
                'data_rilascio' => $project->data_rilascio,
                'responsabile_id' => $project->responsabile_id,
                'progetto_id' => $project->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertEquals($project->titolo, SottoProgetto::first()->titolo);
    }

    public function test_manager_puo_eliminare_sottoprogetto()
    {
        $user = Manager::factory()->create();
        $project = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->delete('/sottoprogetti/' . $project->id)
                ->assertStatus(302);
        $this->assertCount(0, SottoProgetto::all());
    }

    public function test_utente_non_autorizzato_non_puo_creare_sottoprogetto()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->make();
        $this->actingAs($user)
            ->post('/sottoprogetti', [
                'titolo' => $project->titolo,
                'descrizione' => $project->descrizione,
                'data_rilascio' => $project->data_rilascio,
                'responsabile_id' => $project->responsabile_id,
                'progetto_id' => $project->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertCount(0, SottoProgetto::all());
    }

    public function test_utente_non_autorizzato_non_puo_modificare_sottoprogetto()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create();
        $project2 = SottoProgetto::factory()->make();
        $this->actingAs($user)
            ->put('/sottoprogetti/' . $project->id, [
                'titolo' => $project2->titolo,
                'descrizione' => $project2->descrizione,
                'data_rilascio' => $project2->data_rilascio,
                'responsabile_id' => $project2->responsabile_id,
                'progetto_id' => $project2->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertNotEquals($project2->titolo, SottoProgetto::first()->titolo);
    }

    public function test_utente_non_autorizzato_non_puo_eliminare_sottoprogetto()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create();
        $this->actingAs($user)
            ->delete('/sottoprogetti/' . $project->id)
                ->assertStatus(302);
        $this->assertCount(1, SottoProgetto::all());
    }



    public function test_responsabile_puo_aggiungere_ricercatore()
    {
        $user = Responsabile::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $user2 = Ricercatore::factory()->create();
        $this->actingAs($user)
            ->post('/sottoprogetti/' . $project->id . '/add_ricercatore', [
                'ricercatore_id' => $user2->id
            ])
            ->assertStatus(302);
        $this->assertCount(1, $project->ricercatori);
    }

    public function test_responsabile_puo_eliminare_ricercatore()
    {
        $user = Responsabile::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $user2 = Ricercatore::factory()->create();
        $project->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/sottoprogetti/' . $project->id . '/remove_ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(0, $project->ricercatori);
    }

    public function test_responsabile_non_puo_eliminare_ricercatore_se_non_autorizzato()
    {
        $user = Responsabile::factory()->create();
        $project = SottoProgetto::factory()->create();
        $user2 = Ricercatore::factory()->create();
        $project->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/sottoprogetti/' . $project->id . '/remove_ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(1, $project->ricercatori);
    }
    public function test_utente_non_responsabile_non_puo_eliminare_ricercatore()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create();
        $user2 = Ricercatore::factory()->create();
        $project->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/sottoprogetti/' . $project->id . '/remove_ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(1, $project->ricercatori);
    }



}

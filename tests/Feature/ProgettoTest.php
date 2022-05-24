<?php

namespace Tests\Feature;
use App\Models\Manager;
use App\Models\Progetto;
use App\Models\Responsabile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;

class ProgettoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Apertura vista home.
     *
     * @return voids
     */
   /* public function test_creazione_progetti_page_returns_a_successful_response()
    {
        $response = $this->get('/manager/creazioneprogetti');
        $response->assertStatus(200);
    }

    public function test_lista_progetti_page_returns_a_successful_response()
    {
        $response = $this->get('/progetti');
        $response->assertStatus(200);
    }
    */
    public function test_caricamento_views_progetti_manager()
    {
        $user = Manager::factory()->create();
        $progetto= Progetto::factory()->create();

        $this->actingAs($user)
            ->get('/progetti')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetti/create')
            ->assertStatus(200);
    }

    public function test_manager_puo_creare_progetto()
    {
        $user = Manager::factory()->create();
        $project = Progetto::factory()->make();
        $this->actingAs($user)
            ->post('/progetti', [
                'titolo' => $project->titolo,
                'descrizione' => $project->descrizione,
                'scopo' => $project->scopo,
                'datainizio' => $project->data_inizio,
                'datafine' => $project->data_fine,
                'responsabile_id' => $project->responsabile_id,

            ])
            ->assertStatus(302);
        $this->assertCount(1, Progetto::all());
    }
    public function test_manager_puo_modificare_progetto()
    {
        $user = Manager::factory()->create();
        $project = Progetto::factory()->create();
        $this->actingAs($user)
            ->put('/progetti/' . $project->id,  [
                'titolo' => $project->titolo,
                'descrizione' => $project->descrizione,
                'scopo' => $project->scopo,
                'datainizio' => $project->data_inizio,
                'datafine' => $project->data_fine,
                'responsabile_id' => $project->responsabile_id,

            ])
            ->assertStatus(302);
        $this->assertEquals($project->titolo, Progetto::first()->titolo);
    }

    public function test_manager_puo_eliminare_progetto()
    {
        $user = Manager::factory()->create();
        $project = Progetto::factory()->create();
        $this->actingAs($user)
            ->delete('/progetti/' . $project->id)
            ->assertStatus(302);
        $this->assertCount(0, Progetto::all());
    }
}

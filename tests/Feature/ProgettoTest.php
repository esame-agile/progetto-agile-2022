<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Progetto;
use App\Models\Ricercatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgettoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Caricamento delle viste dei progetti per un manager.
     *
     * @return void
     */
    public function test_caricamento_views_progetti_manager(): void
    {
        $user = Manager::factory()->create();
        $progetto = Progetto::factory()->create();

        $this->actingAs($user)
            ->get('/progetto/index')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetto/show/' . $progetto->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetto/edit/' . $progetto->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetto/create')
            ->assertStatus(200);
    }

    /**
     * Manager può creare un progetto.
     *
     * @return void
     */
    public function test_manager_puo_creare_progetto(): void
    {
        $user = Manager::factory()->create();
        $project = Progetto::factory()->make();
        $this->actingAs($user)
            ->post('/progetto/store', [
                'titolo' => $project->titolo,
                'descrizione' => $project->descrizione,
                'scopo' => $project->scopo,
                'data_inizio' => $project->data_inizio,
                'data_fine' => $project->data_fine,
                'budget' => $project->budget,
                'responsabile_id' => $project->responsabile_id,

            ])
            ->assertStatus(302);
        $this->assertCount(1, Progetto::all());
    }

    /**
     * Manager puo modificare un progetto.
     *
     * @return void
     */
    public function test_manager_puo_modificare_progetto(): void
    {
        $user = Manager::factory()->create();
        $project = Progetto::factory()->create();
        $this->actingAs($user)
            ->put('/progetto/update/' . $project->id, [
                'titolo' => $project->titolo,
                'descrizione' => $project->descrizione,
                'scopo' => $project->scopo,
                'datainizio' => $project->data_inizio,
                'datafine' => $project->data_fine,
                'budget' => $project->budget,
                'responsabile_id' => $project->responsabile_id,

            ])
            ->assertStatus(302);
        $this->assertEquals($project->titolo, Progetto::first()->titolo);
    }

    /**
     * Manager può eliminare un progetto.
     *
     * @return void
     */
    public function test_manager_puo_eliminare_progetto(): void
    {
        $user = Manager::factory()->create();
        $project = Progetto::factory()->create();

        $this->actingAs($user)
            ->delete('/progetto/destroy/' . $project->id)
            ->assertStatus(302);

        $this->assertCount(0, Progetto::all());
    }

    /**
     * Responsabile può aggiungere dei ricercatori a un progetto.
     *
     * @return void
     */
    public function test_responsabile_puo_aggiungere_ricercatore(): void
    {
        $user = Ricercatore::factory()->create();
        $project = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $user2 = Ricercatore::factory()->create();
        $this->actingAs($user)
            ->post('/progetto/' . $project->id . '/store-ricercatore', [
                'ricercatori' => [$user2->id]
            ])
            ->assertStatus(302);
        $this->assertCount(1, $project->ricercatori);
    }

    /**
     * Responsabile può rimuovere dei ricercatori da un progetto.
     *
     * @return void
     */
    public function test_responsabile_puo_rimuovere_ricercatore(): void
    {
        $user = Ricercatore::factory()->create();
        $project = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $user2 = Ricercatore::factory()->create();
        $project->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/progetto/' . $project->id . '/remove-ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(0, $project->ricercatori);
    }

    /**
     * Ricercatore non responsabile non può rimuovere un altro ricercatore.
     *
     * @return void
     */
    public function test_ricercatore_non_puo_rimuovere_ricercatore_se_non_e_responsabile(): void
    {
        $user = Ricercatore::factory()->create();
        $project = Progetto::factory()->create();
        $user2 = Ricercatore::factory()->create();
        $project->ricercatori()->attach($user2->id);
        $this->actingAs($user)
            ->delete('/progetto/' . $project->id . '/remove-ricercatore/' . $user2->id)
            ->assertStatus(302);
        $this->assertCount(1, $project->ricercatori);
    }
}

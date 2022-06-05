<?php

namespace Tests\Feature;

use App\Models\Milestone;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MilestoneTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Caricamento delle viste per le milestone di un sotto progetto.
     *
     * @return void
     */
    public function test_caricamento_views_milestones(): void
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->create([
            'sotto_progetto_id' => $sottoProgetto->id,
        ]);

        $this->actingAs($user)
            ->get('/sotto-progetto/' . $sottoProgetto->id . '/milestone/edit/' . $milestone->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sotto-progetto/' . $sottoProgetto->id . '/milestone/create/')
            ->assertStatus(200);
    }

    /**
     * Responsabile del sotto progetto può creare un milestone.
     *
     * @return void
     */
    public function test_responsabile_puo_creare_una_milestone(): void
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->make([
            'sotto_progetto_id' => $sottoProgetto->id,
        ]);
        $this->actingAs($user)
            ->post('/sotto-progetto/' . $sottoProgetto->id . '/milestone/store', [
                'descrizione' => $milestone->descrizione,
                'data_evento' => $milestone->data_evento,
                'responsabile_id' => $milestone->responsabile_id,
                'sotto_progetto_id' => $milestone->sotto_progetto_id,
            ])
            ->assertStatus(302);
        $this->assertCount(1, $sottoProgetto->fresh()->milestones);
    }

    /**
     * Ricercatore non può creare un milestone se non è responsabile del sotto progetto.
     *
     * @return void
     */
    public function test_ricercatone_non_puo_creare_una_milestone_se_non_e_responsabile(): void
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $milestone = Milestone::factory()->make([
            'progetto_id' => $sottoProgetto->id
        ]);
        $this->actingAs($user)
            ->post('/sotto-progetto/' . $sottoProgetto->id . '/milestone/store', [
                'descrizione' => $milestone->descrizione,
                'data_evento' => $milestone->data_evento,
                'responsabile_id' => $milestone->responsabile_id,
                'progetto_id' => $milestone->progetto_id,
            ])
            ->assertStatus(302);
        $this->assertCount(0, $sottoProgetto->fresh()->milestones);
    }

    /**
     * Ricercatore non può eliminare un milestone se non è responsabile del sotto progetto.
     *
     * @return void
     */
    public function test_ricercatone_non_puo_eliminare_una_milestone_se_non_e_responsabile(): void
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create();
        $milestone = Milestone::factory()->create([
            'sotto_progetto_id' => $sottoProgetto->id,
        ]);
        $this->actingAs($user)
            ->delete('/sotto-progetto/' . $sottoProgetto->id . '/milestone/destroy/' . $milestone->id)
            ->assertStatus(302);
        $this->assertCount(1, $sottoProgetto->fresh()->milestones);
    }


    /**
     * Responsabile del sotto progetto può modificare una milestone.
     *
     * @return void
     */
    public function test_responsabile_puo_modificare_una_milestone(): void
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->create([
            'sotto_progetto_id' => $sottoProgetto->id,
        ]);
        $faker = Factory::create();
        $descrizione = $faker->sentence;
        $data_evento = $faker->date;
        $this->actingAs($user)
            ->put('/sotto-progetto/' . $sottoProgetto->id . '/milestone/update/' . $milestone->id, [
                'descrizione' => $descrizione,
                'data_evento' => $data_evento,
                'responsabile_id' => $milestone->responsabile_id,
                'sotto_progetto_id' => $milestone->sotto_progetto_id,
            ])
            ->assertStatus(302);
        $this->assertEquals($descrizione, $milestone->fresh()->descrizione);
        $this->assertEquals($data_evento, $milestone->fresh()->data_evento);
    }

    /**
     * Responsabile del sotto progetto può eliminare una milestone.
     *
     * @return void
     */
    public function test_responsabile_puo_eliminare_una_milestone(): void
    {
        $user = Ricercatore::factory()->create();
        $sottoProgetto = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->create([
            'sotto_progetto_id' => $sottoProgetto->id,
        ]);
        $this->actingAs($user)
            ->delete('/sotto-progetto/' . $sottoProgetto->id . '/milestone/destroy/' . $milestone->id)
            ->assertStatus(302);
        $this->assertCount(0, $sottoProgetto->fresh()->milestones);
    }
}

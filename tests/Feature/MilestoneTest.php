<?php

namespace Tests\Feature;
use App\Models\Milestone;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MilestoneTest extends TestCase
{
    use RefreshDatabase;
    public function test_responsabile_puo_creare_una_milestone()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->make([
            'sotto_progetto_id' => $project->id,
        ]);
        $this->actingAs($user)
            ->post('/sottoprogetti/' . $project->id . '/milestones', [
                'descrizione' => $milestone->descrizione,
                'data_evento' => $milestone->data_evento,
                'responsabile_id' => $milestone->responsabile_id,
                'sotto_progetto_id' => $milestone->sotto_progetto_id,
            ])
            ->assertStatus(302);
        $this->assertCount(1, $project->fresh()->milestones);
    }

    /* Da decommentare quando si aggiunge la gestione dei sottoprogetti
    *
    * public function test_responsabile_non_puo_creare_una_milestone_se_non_ha_il_permesso()
    {
    $user = Ricercatore::factory()->create();
    $project = SottoProgetto::factory()->create();
    $milestone = Milestone::factory()->make([
    'progetto_id' => $project->id
    ]);
    $this->actingAs($user)
    ->post('/sottoprogetti/' . $project->id . '/milestones', [
    'descrizione' => $milestone->descrizione,
    'data_evento' => $milestone->data_evento,
    'responsabile_id' => $milestone->responsabile_id,
    'progetto_id' => $milestone->progetto_id,
    ])
    ->assertStatus(302);
    $this->assertCount(0, $project->fresh()->milestones);
    }
    public function test_responsabile_non_puo_eliminare_una_milestone_se_non_ha_il_permesso()
    {
    $user = Ricercatore::factory()->create();
    $project = SottoProgetto::factory()->create();
    $milestone = Milestone::factory()->create([
    'sotto_progetto_id' => $project->id,
    ]);
    $this->actingAs($user)
    ->delete('/sottoprogetti/' . $project->id . '/milestones/' . $milestone->id)
    ->assertStatus(302);
    $this->assertCount(1, $project->fresh()->milestones);
    }
    */

    public function test_responsabile_puo_modificare_una_milestone()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->create([
            'sotto_progetto_id' => $project->id,
        ]);
        $faker = \Faker\Factory::create();
        $descrizione = $faker->sentence;
        $data_evento = $faker->date;
        $this->actingAs($user)
            ->put('/sottoprogetti/' . $project->id . '/milestones/' . $milestone->id, [
                'descrizione' => $descrizione,
                'data_evento' => $data_evento,
                'responsabile_id' => $milestone->responsabile_id,
                'sotto_progetto_id' => $milestone->sotto_progetto_id,
            ])
            ->assertStatus(302);
        $this->assertEquals($descrizione, $milestone->fresh()->descrizione);
        $this->assertEquals($data_evento, $milestone->fresh()->data_evento);
    }

    public function test_responsabile_puo_eliminare_una_milestone()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->create([
            'sotto_progetto_id' => $project->id,
        ]);
        $this->actingAs($user)
            ->delete('/sottoprogetti/' . $project->id . '/milestones/' . $milestone->id)
            ->assertStatus(302);
        $this->assertCount(0, $project->fresh()->milestones);
    }

    public function test_caricamento_views_milestones()
    {
        $user = Ricercatore::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $milestone = Milestone::factory()->create([
            'sotto_progetto_id' => $project->id,
        ]);
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id . '/milestones/')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id . '/milestones/' . $milestone->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id . '/milestones/' . $milestone->id . '/edit')
            ->assertStatus(200);
    }

}

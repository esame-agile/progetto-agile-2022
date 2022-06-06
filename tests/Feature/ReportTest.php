<?php

namespace Tests\Feature;

use App\Models\Progetto;
use App\Models\Report;
use App\Models\Ricercatore;
use Tests\TestCase;

class ReportTest extends TestCase
{
    /**
     * Caricamento viste per i report.
     *
     * @return void
     */
    public function test_caricamento_views_create_report(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create();
        $progetto->ricercatori()->attach($user);

        $this->actingAs($user)
            ->get('/report/create/' . $progetto->id)
            ->assertStatus(200);
    }

    /**
     * Caricamento viste per i report.
     *
     * @return void
     */
    public function test_ricercatore_che_crea_un_report_puo_eliminarlo(): void
    {
        $user = Ricercatore::factory()->create();
        $report = Report::factory()->create([
            'ricercatore_id' => $user->id,
        ]);
        $progetto = Progetto::factory()->create();
        $progetto->ricercatori()->attach($user);
        $progetto->reports()->saveMany([$report]);
        $progetto->save();

        $this->actingAs($user)
            ->delete('/report/destroy/' . $report->id)
            ->assertStatus(302);
    }
}

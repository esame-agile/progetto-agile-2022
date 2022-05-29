<?php

namespace Tests\Feature;

use App\Models\Finanziatore;
use App\Models\Manager;
use App\Models\Progetto;
use App\Models\Report;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
use Tests\TestCase;

class ReportTest extends TestCase
{

    public function test_caricamento_views_create_report()
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create();
        $progetto->ricercatori()->attach($user);

        $this->actingAs($user)
            ->get('/report/create/' . $progetto->id)
            ->assertStatus(200);
    }



}

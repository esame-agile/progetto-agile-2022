<?php

namespace Tests\Feature;

use App\Models\Progetto;
use App\Models\Ricercatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class VisionareProgettiTest extends TestCase
{
    use RefreshDatabase;

    public function test_tutti_i_progetti_navbarButton_returns_a_successful_response()
    {

        $response = $this->get('/progetto/index');

        $response->assertStatus(200);
    }

    public function test_progetto_buttonName_returns_a_successful_response()
    {
        $progetto = Progetto::factory()->create();

        $response = $this->get('/progetto/show/' . $progetto->id);

        $response->assertStatus(200);
    }
}

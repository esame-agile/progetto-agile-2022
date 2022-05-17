<?php

namespace Tests\Feature;

use App\Models\Ricercatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class RicercatoriTest extends TestCase
{
    use RefreshDatabase;

    public function test_ricercatore_buttonName_returns_a_successful_response()
    {
        $ricercatore = Ricercatore::factory()->create();

        $response = $this->get('/pagina-personale/ricercatore/index/'.$ricercatore->id);

        $response->assertStatus(200);
    }
}

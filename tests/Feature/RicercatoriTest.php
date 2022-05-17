<?php

namespace Tests\Feature;

use App\Models\Ricercatore;
use Tests\TestCase;


class RicercatoriTest extends TestCase
{

    public function test_ricercatore_buttonName_returns_a_successful_response()
    {
        $ricercatore = Ricercatore::factory()->create();

        $response = $this->get('/pagina-personale/ricercatore/index/'.$ricercatore->id_utente);

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Ricercatore;
use Tests\TestCase;
use \Illuminate\Foundation\Testing\RefreshDatabase;

class RicercatoriTest extends TestCase
{
    use RefreshDatabase;
    public function test_the_ricercatore_buttonName_returns_a_successful_response()
    {
        $ricercatore = Ricercatore::factory()->create([
            'ruolo' => 'ricercatore',
        ]);

        $response = $this->get('/pagina-personale/ricercatore/index/'.$ricercatore->id_utente);

        $response->assertStatus(200);
    }
}

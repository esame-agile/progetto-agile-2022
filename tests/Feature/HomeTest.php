<?php

namespace Tests\Feature;

use App\Models\Utente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * Apertura vista home.
     *
     * @return void
     */
    public function test_the_home_page_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Apertura vista login.
     *
     * @return void
     */
    public function test_the_login_button_returns_a_successful_response()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
//    public function test_the_ricercatori_button_returns_a_successful_response()
//    {
//        $response = $this->get('/ricercatori');
//
//        $response->assertStatus(200);
//    }
//    public function test_the_ricercatore_buttonName_returns_a_successful_response()
//    {
//        $response = $this->get('/pagina-personale/index/1');
//
//        $response->assertStatus(200);
//    }
}

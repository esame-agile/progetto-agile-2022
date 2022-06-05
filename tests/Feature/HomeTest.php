<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Apertura vista home.
     *
     * @return void
     */
    public function test_the_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Apertura vista login.
     *
     * @return void
     */
    public function test_the_login_button_returns_a_successful_response(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Apertura lista ricercatori.
     *
     * @return void
     */
    public function test_ricercatori_button_returns_a_successful_response(): void
    {
        $response = $this->get('/ricercatore/index');

        $response->assertStatus(200);
    }

    /**
     * Apertura lista progetti.
     *
     * @return void
     */
    public function test_progetti_button_returns_a_successful_response(): void
    {
        $response = $this->get('/progetto/index');

        $response->assertStatus(200);
    }
}

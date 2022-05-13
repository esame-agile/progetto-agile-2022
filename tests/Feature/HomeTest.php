<?php

namespace Tests\Feature;

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
}

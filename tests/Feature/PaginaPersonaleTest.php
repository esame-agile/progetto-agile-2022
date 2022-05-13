<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginaPersonaleTest extends TestCase
{
    /**
     * Apertura vista pagina-personale.
     *
     * @return void
     */
    public function test_the_pagina_personale_returns_a_successful_response()
    {
        $response = $this->get('/pagina-personale');

        $response->assertStatus(200);
    }
}

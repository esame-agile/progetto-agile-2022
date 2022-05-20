<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;

class ProgettoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Apertura vista home.
     *
     * @return voids
     */
    public function test_creazione_progetti_page_returns_a_successful_response()
    {
        $response = $this->get('/manager/creazioneprogetti');

        $response->assertStatus(200);
    }

    public function test_lista_progetti_page_returns_a_successful_response()
    {
        $response = $this->get('/manager/tuttiprogetti');

        $response->assertStatus(200);
    }

}

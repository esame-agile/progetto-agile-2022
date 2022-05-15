<?php

namespace Tests\Feature;

use App\Models\Ricercatore;
use Faker;
use Tests\TestCase;

class PaginaPersonaleTest extends TestCase
{
    /**
     * Apertura vista pagina-personale.
     *
     * @return void
     */
    public function test_the_pagina_personale_index_returns_a_successful_response()
    {

        $ricercatore = Ricercatore::factory()->create();
        $this->post('/login', [
            'email' => $ricercatore->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/pagina-personale/ricercatore/index');

        $response->assertStatus(200);
    }

    public function test_the_pagina_personale_non_puo_essere_visualizzata_da_un_guest_index_returns_a_successful_response()
    {
        $response = $this->get('/pagina-personale/ricercatore/index');
        $response->assertStatus(302);
    }

    public function test_the_utente_puo_accedere_alla_pagina_di_modifica_delle_sue_informazioni_index_returns_a_successful_response()
    {
        $ricercatore =  Ricercatore::factory()->create();
        $this->post('/login', [
            'email' => $ricercatore->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/pagina-personale/ricercatore/edit-info/'.$ricercatore->id_utente);

        $response->assertStatus(200);
    }

    public function test_the_utente_puo_modificare_i_suoi_campi_index_returns_a_successful_response()
    {
        $faker = Faker\Factory::create();;
        $ricercatore =  Ricercatore::factory()->create();
        $this->post('/login', [
            'email' => $ricercatore->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $this->get('/pagina-personale/ricercatore/edit-info/'.$ricercatore->id_utente);
        $response = $this->put('pagina-personale/ricercatore/update-info/'.$ricercatore->id_utente, [
            'nome' => $faker->firstName(),
            'cognome' => $faker->lastName(),
            'email' => $faker->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'data_nascita' => '2000-01-01',
            'universita' => 'Università di {$faker->city()}',
            'ambito_ricerca' => 'Ingegneria',
        ]);

        $response->assertRedirect('pagina-personale/ricercatore/index?utente='.$ricercatore->id_utente);
    }

    public function test_the_pagina_edit_restituisce_errore_se_i_campi_non_sono_validi_index_returns_a_successful_response()
    {
        $ricercatore =  Ricercatore::factory()->create();
        $this->post('/login', [
            'email' => $ricercatore->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $this->get('/pagina-personale/ricercatore/edit-info/'.$ricercatore->id_utente);
        $response = $this->put('pagina-personale/ricercatore/update-info/'.$ricercatore->id_utente, [
            'nome' => '',
            'cognome' => '',
            'email' => '',
            'password' => '', // password
            'password_confirmation' => '', // password
            'data_nascita' => '',
            'universita' => '',
            'ambito_ricerca' => '',
        ]);

        $response->assertRedirect('pagina-personale/ricercatore/edit-info/'.$ricercatore->id_utente);
    }

    public function test_the_guest_non_puo_modificare_informazioni_di_un_utente_index_returns_a_successful_response()
    {
        $response = $this->get('/pagina-personale/ricercatore/edit-info/'.rand(1,10));
        $response->assertStatus(302);
    }
}

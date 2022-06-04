<?php

namespace Tests\Feature;

use App\Models\Ricercatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;


class RicercatoriTest extends TestCase
{
    use RefreshDatabase;

    public function test_ricercatore_buttonName_returns_a_successful_response()
    {
        $ricercatore = Ricercatore::factory()->make();
        $response = $this->get('ricercatore/show/' . $ricercatore->id);
        $response->assertStatus(200);
    }

    public function test_pagina_personale_show_returns_a_successful_response()
    {
        $ricercatore = Ricercatore::factory()->create();
        $this->actingAs($ricercatore);
        $response = $this->get('/ricercatore/show');

        $response->assertStatus(200);
    }

    public function test_pagina_personale_non_puo_essere_visualizzata_da_un_guest()
    {
        $response = $this->get('/ricercatore/show');
        $response->assertStatus(302);
    }

    public function test_ricercatore_puo_accedere_alla_pagina_di_modifica_delle_sue_informazioni()
    {
        $ricercatore = Ricercatore::factory()->create();
        $this->actingAs($ricercatore);
        $response = $this->get('/ricercatore/edit/' . $ricercatore->id);
        $response->assertStatus(200);
    }

    public function test_ricercatore_puo_modificare_i_suoi_campi()
    {
        $faker = Faker\Factory::create();
        $ricercatore = Ricercatore::factory()->create();
        $this->actingAs($ricercatore)
            ->put('/ricercatore/update/' . $ricercatore->id, [
                'nome' => $faker->firstName(),
                'cognome' => $faker->lastName(),
                'email' => $faker->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'data_nascita' => '2000-01-01',
                'universita' => 'Università di {$faker->city()}',
                'ambito_ricerca' => 'Ingegneria',
            ])->assertRedirect('/ricercatore/show?ricercatore=' . $ricercatore->id);
    }

    public function test_pagina_edit_restituisce_errore_se_i_campi_non_sono_validi()
    {
        $ricercatore = Ricercatore::factory()->create();
        $this->actingAs($ricercatore)
            ->put('/ricercatore/update/' . $ricercatore->id, [
                'nome' => '',
                'cognome' => '',
                'email' => '',
                'password' => '', // password
                'password_confirmation' => '', // password
                'data_nascita' => '',
                'universita' => '',
                'ambito_ricerca' => '',
            ])->assertRedirect('/');
    }

    public function test_guest_non_puo_modificare_informazioni_di_un_ricercatore()
    {
        Ricercatore::factory(1)->create();
        $this->get('ricercatore/edit/1')->assertStatus(302);
    }
}

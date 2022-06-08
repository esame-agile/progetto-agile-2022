<?php

namespace Tests\Feature;

use App\Models\Ricercatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;


class RicercatoriTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Cliccando sul nome di un ricercatore si accederà alla sua pagina di profilo.
     *
     * @return void
     */
    public function test_ricercatore_buttonName_returns_a_successful_response(): void
    {
        $ricercatore = Ricercatore::factory()->create();
        $response = $this->get('ricercatore/show/' . $ricercatore->id);
        $response->assertStatus(200);
    }

    /**
     * Un ricercatore può accedere alla sua pagina di profilo.
     *
     * @return void
     */
    public function test_pagina_personale_show_returns_a_successful_response(): void
    {
        $ricercatore = Ricercatore::factory()->create();
        $this->actingAs($ricercatore);
        $response = $this->get('/ricercatore/show');

        $response->assertStatus(200);
    }

    /**
     * Un guest non può accedere alla pagina personale di un ricercatore senza autenticarsi.
     *
     * @return void
     */
    public function test_pagina_personale_non_puo_essere_visualizzata_da_un_guest(): void
    {
        $response = $this->get('/ricercatore/show');
        $response->assertStatus(302);
    }

    /**
     * Un ricercatore può accedere alla pagina di modifica delle sue informazioni.
     *
     * @return void
     */
    public function test_ricercatore_puo_accedere_alla_pagina_di_modifica_delle_sue_informazioni(): void
    {
        $ricercatore = Ricercatore::factory()->create();
        $this->actingAs($ricercatore);
        $response = $this->get('/ricercatore/edit/' . $ricercatore->id);
        $response->assertStatus(200);
    }

    /**
     * Un ricercatore può modificare le sue informazioni.
     *
     * @return void
     */
    public function test_ricercatore_puo_modificare_i_suoi_campi(): void
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
                'pid' => '0001',
            ])->assertRedirect('/ricercatore/show?ricercatore=' . $ricercatore->id);
    }

    /**
     * Un ricercatore non può modificare le sue informazioni se i campi sono errati.
     *
     * @return void
     */
    public function test_pagina_edit_restituisce_errore_se_i_campi_non_sono_validi(): void
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

    /**
     * Un guest non può modificare le informazioni di un ricercatore.
     *
     * @return void
     */
    public function test_guest_non_puo_modificare_informazioni_di_un_ricercatore(): void
    {
        Ricercatore::factory(1)->create();
        $this->get('ricercatore/edit/1')->assertStatus(302);
    }
}

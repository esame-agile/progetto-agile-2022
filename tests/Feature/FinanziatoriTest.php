<?php

namespace Tests\Feature;

use App\Models\Finanziatore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;


class FinanziatoriTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pagina personale finanziatore.
     *
     * @return void
     */
    public function test_pagina_personale_show_returns_a_successful_response(): void
    {
        $finanziatore = Finanziatore::factory()->create();
        $this->actingAs($finanziatore);
        $response = $this->get('/finanziatore/show');

        $response->assertStatus(200);
    }

    /**
     * Pagina personale finanziatore non può essere visualizzata da un guest.
     *
     * @return void
     */
    public function test_pagina_personale_non_puo_essere_visualizzata_da_un_guest(): void
    {
        $response = $this->get('/finanziatore/show');
        $response->assertStatus(302);
    }

    /**
     * Pagina di modifica dell informazioni di un finanziatore.
     *
     * @return void
     */
    public function test_finanziatore_puo_accedere_alla_pagina_di_modifica_delle_sue_informazioni(): void
    {
        $finanziatore = Finanziatore::factory()->create();
        $this->actingAs($finanziatore);
        $response = $this->get('/finanziatore/edit/' . $finanziatore->id);

        $response->assertStatus(200);
    }

    /**
     * Il finanziatore può modificare i suoi dati.
     *
     * @return void
     */
    public function test_finanziatore_puo_modificare_i_suoi_dati(): void
    {
        $faker = Faker\Factory::create();
        $finanziatore = Finanziatore::factory()->create();
        $this->actingAs($finanziatore)
            ->put('/finanziatore/update/' . $finanziatore->id, [
                'nome' => $faker->firstName(),
                'cognome' => $faker->lastName(),
                'email' => $faker->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'nome_azienda' => 'Azienda',
            ])->assertRedirect('/finanziatore/show');
    }

    /**
     * Il finanziatore non può modificare i suoi dati se i campi non sono validi.
     *
     * @return void
     */
    public function test_pagina_edit_restituisce_errore_se_i_campi_non_sono_validi(): void
    {
        $finanziatore = Finanziatore::factory()->create();
        $this->actingAs($finanziatore)
            ->put('/finanziatore/update/' . $finanziatore->id, [
                'nome' => '',
                'cognome' => '',
                'email' => '',
                'password' => '', // password
                'password_confirmation' => '', // password
                'nome_azienda' => '',
            ])->assertRedirect('/');
    }

    /**
     * Un guest non può modificare i dati di un finanziatore.
     *
     * @return void
     */
    public function test_guest_non_puo_modificare_le_informazioni_di_un_finanziatore(): void
    {
        Finanziatore::factory(1)->create();
        $this->get('finanziatore/edit/1')->assertStatus(302);
    }
}

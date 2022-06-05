<?php

namespace Tests\Feature;

use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;


class ManagerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pagina personale manager.
     *
     * @return void
     */
    public function test_pagina_personale_show_returns_a_successful_response(): void
    {
        $manager = Manager::factory()->create();
        $this->actingAs($manager);
        $response = $this->get('/manager/show');

        $response->assertStatus(200);
    }

    /**
     * Pagina personale manager non può essere visualizzata da un guest.
     *
     * @return void
     */
    public function test_pagina_personale_non_puo_essere_visualizzata_da_un_guest(): void
    {
        $response = $this->get('/manager/show');
        $response->assertStatus(302);
    }

    /**
     * Pagina di modifica dell informazioni di un manager.
     *
     * @return void
     */
    public function test_manager_puo_accedere_alla_pagina_di_modifica_delle_sue_informazioni(): void
    {
        $manager = Manager::factory()->create();
        $this->actingAs($manager);
        $response = $this->get('/manager/edit/' . $manager->id);

        $response->assertStatus(200);
    }

    /**
     * Il manager può modificare i suoi dati.
     *
     * @return void
     */
    public function test_manager_puo_modificare_i_suoi_dati(): void
    {
        $faker = Faker\Factory::create();
        $manager = Manager::factory()->create();
        $this->actingAs($manager)
            ->put('/manager/update/' . $manager->id, [
                'nome' => $faker->firstName(),
                'cognome' => $faker->lastName(),
                'email' => $faker->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ])->assertRedirect('/manager/show?manager=' . $manager->id);
    }

    /**
     * Il manager non può modificare i suoi dati se i campi non sono validi.
     *
     * @return void
     */
    public function test_pagina_edit_restituisce_errore_se_i_campi_non_sono_validi(): void
    {
        $manager = Manager::factory()->create();
        $this->actingAs($manager)
            ->put('/manager/update/' . $manager->id, [
                'nome' => '',
                'cognome' => '',
                'email' => '',
                'password' => '', // password
                'password_confirmation' => '', // password
            ])->assertRedirect('/');
    }

    /**
     * Un guest non può modificare i dati di un manager.
     *
     * @return void
     */
    public function test_guest_non_puo_modificare_le_informazioni_di_un_manager(): void
    {
        Manager::factory(1)->create();
        $this->get('manager/edit/1')->assertStatus(302);
    }
}

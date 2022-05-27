<?php

namespace Tests\Feature;

use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;


class ManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_pagina_personale_show_returns_a_successful_response()
    {
        $manager = Manager::factory()->create();
        $this->actingAs($manager);
        $response = $this->get('/manager/show');

        $response->assertStatus(200);
    }

    public function test_pagina_personale_non_puo_essere_visualizzata_da_un_guest()
    {
        $response = $this->get('/manager/show');
        $response->assertStatus(302);
    }

    public function test_manager_puo_accedere_alla_pagina_di_modifica_delle_sue_informazioni()
    {
        $manager = Manager::factory()->create();
        $this->actingAs($manager);
        $response = $this->get('/manager/edit/' . $manager->id);

        $response->assertStatus(200);
    }

    public function test_manager_puo_modificare_i_suoi_campi()
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

    public function test_pagina_edit_restituisce_errore_se_i_campi_non_sono_validi()
    {
        $faker = Faker\Factory::create();
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

    public function test_guest_non_puo_modificare_informazioni_di_un_manager()
    {
        Manager::factory(1)->create();
        $this->get('manager/edit/1')->assertStatus(302);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Movimento;
use App\Models\Progetto;
use App\Models\Ricercatore;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovimentiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Caricamento delle viste per i movimenti di un progetto per un responsabile.
     *
     * @return void
     */
    public function test_caricamento_views_movimenti_responsabile(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $progetto->ricercatori()->attach($user);
        $movimento = Movimento::factory()->create([
            'progetto_id' => $progetto->id
        ]);

        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/index')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/edit/' . $movimento->id)
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/create')
            ->assertStatus(200);
    }

    /**
     * Caricamento delle viste per i movimenti di un progetto per un manager.
     *
     * @return void
     */
    public function test_caricamento_views_movimenti_manager(): void
    {
        $user = Manager::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/index')
            ->assertStatus(200);
    }

    /**
     * Caricamento delle viste per i movimenti di un progetto per un ricercatore.
     *
     * @return void
     */
    public function test_caricamento_views_movimenti_ricercatore(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/index')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/create')
            ->assertStatus(200);
    }

    /**
     * Caricamento delle viste per i movimenti di un progetto per un ricercatore.
     *
     * @return void
     */
    public function test_caricamento_views_movimenti_finanziatore(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/index')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get('/progetto/' . $progetto->id . '/movimento/create')
            ->assertStatus(200);
    }

    /**
     * Guest non puà visualizzare o editare un movimento.
     *
     * @return void
     */
    public function test_guest_non_puo_visualizzare_o_editare_i_movimenti(): void
    {
        $progetto = Progetto::factory()->create();
        $movimento = Movimento::factory()->create([
            'progetto_id' => $progetto->id
        ]);
        $this->get('/progetto/' . $progetto->id . '/movimento/index')->assertStatus(302);
        $this->get('/progetto/' . $progetto->id . '/movimento/create')->assertStatus(302);
        $this->get('/progetto/' . $progetto->id . '/movimento/edit/' . $movimento->id)->assertStatus(302);
        $this->put('/progetto/' . $progetto->id . '/movimento/update/' . $movimento->id)->assertStatus(302);
        $this->delete('/progetto/' . $progetto->id . '/movimento/destroy/' . $movimento->id)->assertStatus(302);
    }

    /**
     * Ricercatore può creare un movimento per un progetto ad egli assegnato.
     *
     * @return void
     */
    public function test_ricercatore_puo_creare_un_movimento(): void
    {
        $faker = Faker\Factory::create();
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create();
        $progetto->ricercatori()->attach($user);
        $progetto->save();

        $this->actingAs($user)
            ->post('/progetto/' . $progetto->id . '/movimento/store', [
                'causale' => $faker->sentence,
                'importo' => $faker->randomFloat(2, 0, 100),
            ])
            ->assertRedirect('/progetto/' . $progetto->id . '/movimento/index');

        $this->assertCount(1, Movimento::all());
    }

    /**
     * Ricercatore può accettare un movimento.
     *
     * @return void
     */
    public function test_responsabile_puo_accettare_un_movimento(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $movimento = Movimento::factory()->create([
            'progetto_id' => $progetto->id,
            'approvazione' => 0
        ]);
        $this->actingAs($user)
            ->put('/progetto/' . $progetto->id . '/movimento/approva/' . $movimento->id)
            ->assertStatus(302);

        $movimento = Movimento::find($movimento->id);
        $this->assertEquals(1, $movimento->approvazione);
    }

    /**
     * Ricercatore può accettare un movimento.
     *
     * @return void
     */
    public function test_responsabile_puo_rifiutare_un_movimento(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $movimento = Movimento::factory()->create([
            'progetto_id' => $progetto->id,
            'approvazione' => 0
        ]);
        $this->actingAs($user)
            ->put('/progetto/' . $progetto->id . '/movimento/disapprova/' . $movimento->id)
            ->assertStatus(302);

        $movimento = Movimento::find($movimento->id);
        $this->assertEquals(2, $movimento->approvazione);
    }

    /**
     * Movimento non può essere eliminato dopo essere stato accettato o rifiutato..
     *
     * @return void
     */
    public function test_movimento_non_puo_essere_eliminato_dopo_essere_stato_accettato_o_rifiutato(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $movimento = Movimento::factory()->create([
            'progetto_id' => $progetto->id,
            'approvazione' => 1
        ]);
        $this->actingAs($user)
            ->delete('/progetto/' . $progetto->id . '/movimento/destroy/' . $movimento->id)
            ->assertStatus(302);

        $this->assertCount(1, Movimento::all());
    }

    /**
     * Un movimento accettato va a modificare il budget del progetto.
     *
     * @return void
     */
    public function test_un_movimento_accettato_va_a_modificare_il_budget_del_progetto(): void
    {
        $user = Ricercatore::factory()->create();
        $progetto = Progetto::factory()->create([
            'responsabile_id' => $user->id,
            'budget' => 100,
        ]);
        $movimento = Movimento::factory()->create([
            'progetto_id' => $progetto->id,
            'importo' => -50,
            'approvazione' => 0
        ]);
        $this->actingAs($user)
            ->put('/progetto/' . $progetto->id . '/movimento/approva/' . $movimento->id)
            ->assertStatus(302);

        $progetto = Progetto::find($progetto->id);
        $this->assertEquals(50, $progetto->budget);
    }

}

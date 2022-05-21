<?php

namespace Tests\Feature;

use App\Models\Responsabile;
use App\Models\SottoProgetto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SottoProgettiTest extends TestCase
{
    use RefreshDatabase;
    public function test_caricamento_views_sottoprogetti()
    {
        $user = Responsabile::factory()->create();
        $project = SottoProgetto::factory()->create([
            'responsabile_id' => $user->id
        ]);
        $this->actingAs($user)
            ->get('/sottoprogetti/' . $project->id)
            ->assertStatus(200);
    }
}

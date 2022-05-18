<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaginaPersonaleController;
use App\Http\Controllers\RicercatoriController;
use Illuminate\Support\Facades\Route;



/**
 * Vista home.
 *
 */
Route::get('/', function () {
    $nav = [
        ['label' => 'TOP 5', 'class' => 'page-scroll', 'href' => '#testimonial'],        ['label' => 'CHI SIAMO', 'class' => 'page-scroll', 'href' => '#service'],
    ];
    return view('home', compact('nav'));
});


Route::prefix('pagina-personale/ricercatore')->group(function () {
    /**
     * Vista pagina personale di un ricercatore per i non autenticati.
     *
     */
    Route::get('/index/{utente}', [PaginaPersonaleController::class, 'guest_index'])->name('pagina-personale.ricercatore.guest-index');

    /**
     * Vista pagina personale di un ricercatore.
     *
     */
    Route::get('/index', [PaginaPersonaleController::class, 'index'])->name('pagina-personale.ricercatore.index')->middleware('auth');

    /**
     * Vista per editare le informazioni di un ricercatore.
     *
     */
    Route::get('/edit-info/{utente}', [PaginaPersonaleController::class, 'edit_info'])->name('pagina-personale.ricercatore.edit-info')->middleware('auth');

    /**
     * Aggiorna le informazioni di un utente.
     *
     */
    Route::put('/update-info/{utente}', [PaginaPersonaleController::class, 'update_info'])->name('pagina-personale.ricercatore.update-info')->middleware('auth');
});

/**
 * Elenco ricercatori per un guest.
 *
 */
Route::get('/ricercatori', [RicercatoriController::class, 'index'])->name('ricercatori');

require __DIR__ . '/auth.php';

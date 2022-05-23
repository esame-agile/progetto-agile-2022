<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Milestones\MilestoneController;
use App\Http\Controllers\PaginaPersonaleController;
use App\Http\Controllers\ProgettoController;
use App\Http\Controllers\RicercatoriController;
use App\Http\Controllers\SottoProgettoController;
use Illuminate\Support\Facades\Route;

/**
 * Vista home.
 *
 */
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('manager/creazioneprogetti', [ProgettoController::class, 'index']);
Route::post('manager/creazioneprogetti',[ProgettoController::class, 'storeProgetto'])->name('creaprogetto');
Route::get('manager/tuttiprogetti', [ProgettoController::class, 'tuttiProgetti']);
Route::get('manager/modificaprogetto/{id}', [ProgettoController::class, 'edit']);
Route::post('manager/modificaprogetto/{id}', [ProgettoController::class, 'update']);


Route::get('ricercatore/ricercatori', [RicercatoriController::class, 'index']);
Route::get('ricercatore/imieiprogetti', [RicercatoriController::class, 'iMieiProgetti']);

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

/**
 * CRUD per i progetti.
 */

/**
 * CRUD per i sottoprogetti.
 */
Route::resource('sottoprogetti', SottoProgettoController::class)->middleware('auth')->middleware('ruolo:responsabile,manager,ricercatore');
Route::get('sottoprogetti/{sottoProgetto}/edit_ricercatori', [SottoProgettoController::class, 'editRicercatori'])->name('sottoprogetti.edit_ricercatori')->middleware(['auth','ruolo:responsabile']);
Route::delete('sottoprogetti/{sottoProgetto}/remove_ricercatore/{ricercatore}', [SottoProgettoController::class, 'removeRicercatore'])->name("sottoprogetti.remove_ricercatore")->middleware(['auth','ruolo:responsabile']);
Route::get("sottoprogetti/{sottoProgetto}/add_ricercatore", [SottoProgettoController::class, 'addRicercatoreView'])->name("sottoprogetti.add_ricercatore")->middleware(['auth','ruolo:responsabile']);
Route::post("sottoprogetti/{sottoProgetto}/add_ricercatore", [SottoProgettoController::class, 'addRicercatore'])->name("sottoprogetti.add_ricercatore")->middleware(['auth','ruolo:responsabile']);

/**
 * CRUD per le milestones.
 */
Route::resource('sottoprogetti.milestones', MilestoneController::class)->middleware('auth')->middleware('ruolo:responsabile,manager');

require __DIR__ . '/auth.php';

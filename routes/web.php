<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Milestones\MilestoneController;
use App\Http\Controllers\PaginaPersonaleFinanziatoreController;
use App\Http\Controllers\PaginaPersonaleManagerController;
use App\Http\Controllers\PaginaPersonaleRicercatoreController;
use App\Http\Controllers\ProgettoController;
use App\Http\Controllers\RicercatoreController;
use App\Http\Controllers\SottoProgettoController;
use Illuminate\Support\Facades\Route;

/**
 * Vista home.
 *
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('progetti', ProgettoController::class);
Route::get('progetti/{progetto}/edit_ricercatori', [ProgettoController::class, 'editRicercatori'])->name('progetti.edit_ricercatori')->middleware(['auth']);
Route::delete('progetti/{progetto}/remove_ricercatore/{ricercatore}', [ProgettoController::class, 'removeRicercatore'])->name("progetti.remove_ricercatore")->middleware(['auth']);
Route::get("progetti/{progetto}/add_ricercatore", [ProgettoController::class, 'addRicercatoreView'])->name("progetti.add_ricercatore")->middleware(['auth']);
Route::post("progetti/{progetto}/add_ricercatore", [ProgettoController::class, 'addRicercatore'])->name("progetti.add_ricercatore")->middleware(['auth']);


Route::get('ricercatore/ricercatori', [RicercatoreController::class, 'index']);

Route::get('ricercatore/mieiprogetti', [ProgettoController::class, 'mieiProgetti'])->name('progetti.mieiprogetti');


Route::prefix('pagina-personale/ricercatore')->group(function () {

    /**
     * Vista pagina personale di un ricercatore per i non autenticati.
     *
     */
    Route::get('/index/{utente}', [PaginaPersonaleRicercatoreController::class, 'guest_index'])->name('pagina-personale.ricercatore.guest-index');

    /**
     * Vista pagina personale di un ricercatore.
     *
     */
    Route::get('/index', [PaginaPersonaleRicercatoreController::class, 'index'])->name('pagina-personale.ricercatore.index')->middleware('auth');

    /**
     * Vista per editare le informazioni di un ricercatore.
     *
     */
    Route::get('/edit-info/{utente}', [PaginaPersonaleRicercatoreController::class, 'edit_info'])->name('pagina-personale.ricercatore.edit-info')->middleware('auth');

    /**
     * Aggiorna le informazioni di un utente.
     *
     */
    Route::put('/update-info/{utente}', [PaginaPersonaleRicercatoreController::class, 'update_info'])->name('pagina-personale.ricercatore.update-info')->middleware('auth');
});

Route::prefix('pagina-personale/manager')->group(function () {

    /**
     * Vista pagina personale di un manager.
     *
     */
    Route::get('/index', [PaginaPersonaleManagerController::class, 'index'])->name('pagina-personale.manager.index')->middleware('auth');

    /**
     * Vista per editare le informazioni di un manager.
     *
     */
    Route::get('/edit-info/{utente}', [PaginaPersonaleManagerController::class, 'edit_info'])->name('pagina-personale.manager.edit-info')->middleware('auth');

    /**
     * Aggiorna le informazioni di un manager.
     *
     */
    Route::put('/update-info/{utente}', [PaginaPersonaleManagerController::class, 'update_info'])->name('pagina-personale.manager.update-info')->middleware('auth');
});

Route::prefix('pagina-personale/finanziatore')->group(function () {

    /**
     * Vista pagina personale di un finanziatore.
     *
     */
    Route::get('/index', [PaginaPersonaleFinanziatoreController::class, 'index'])->name('pagina-personale.finanziatore.index')->middleware('auth');

    /**
     * Vista per editare le informazioni di un finanziatore.
     *
     */
    Route::get('/edit-info/{utente}', [PaginaPersonaleFinanziatoreController::class, 'edit_info'])->name('pagina-personale.finanziatore.edit-info')->middleware('auth');

    /**
     * Aggiorna le informazioni di un finanziatore.
     *
     */
    Route::put('/update-info/{utente}', [PaginaPersonaleFinanziatoreController::class, 'update_info'])->name('pagina-personale.finanziatore.update-info')->middleware('auth');
});
/**
 * Elenco ricercatori per un guest.
 *
 */
Route::get('/ricercatori', [RicercatoreController::class, 'index'])->name('ricercatori');

/**
 * CRUD per i progetti.
 */

/**
 * CRUD per i sottoprogetti.
 */
Route::resource('sottoprogetti', SottoProgettoController::class);
Route::get('sottoprogetti/{sottoProgetto}/edit_ricercatori', [SottoProgettoController::class, 'editRicercatori'])->name('sottoprogetti.edit_ricercatori')->middleware(['auth','ruolo:ricercatore']);
Route::delete('sottoprogetti/{sottoProgetto}/remove_ricercatore/{ricercatore}', [SottoProgettoController::class, 'removeRicercatore'])->name("sottoprogetti.remove_ricercatore")->middleware(['auth','ruolo:ricercatore']);
Route::get("sottoprogetti/{sottoProgetto}/add_ricercatore", [SottoProgettoController::class, 'addRicercatoreView'])->name("sottoprogetti.add_ricercatore")->middleware(['auth','ruolo:ricercatore']);
Route::post("sottoprogetti/{sottoProgetto}/add_ricercatore", [SottoProgettoController::class, 'addRicercatore'])->name("sottoprogetti.add_ricercatore")->middleware(['auth','ruolo:ricercatore']);

/**
 * CRUD per le milestones.
 */
Route::resource('sottoprogetti.milestones', MilestoneController::class)->middleware('auth')->middleware('ruolo:ricercatore,manager');

require __DIR__ . '/auth.php';

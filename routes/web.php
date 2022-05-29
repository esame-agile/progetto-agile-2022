<?php

use App\Http\Controllers\FinanziatoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProgettoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RicercatoreController;
use App\Http\Controllers\SottoProgettoController;
use Illuminate\Support\Facades\Route;

/**
 * Vista home
 */
Route::get('/', [HomeController::class, 'index'])->name('home');
/**
 * CRUD per il ricercatore
 */
Route::prefix('ricercatore')->group(function () {

    /**
     * Vista elenco dei ricercatori per un guest.
     *
     */
    Route::get('/index', [RicercatoreController::class, 'index'])->name('ricercatore.index');

    /**
     * Vista pagina personale di un ricercatore per un guest.
     *
     */
    Route::get('/show/{ricercatore}', [RicercatoreController::class, 'guest_show'])->name('ricercatore.guest-show');

    /**
     * Vista pagina personale di un ricercatore.
     *
     */
    Route::get('/show', [RicercatoreController::class, 'show'])->name('ricercatore.show')->middleware('auth');

    /**
     * Vista per editare le informazioni di un ricercatore.
     *
     */
    Route::get('/edit/{ricercatore}', [RicercatoreController::class, 'edit'])->name('ricercatore.edit')->middleware('auth');

    /**
     * Aggiorna le informazioni di un ricercatore.
     *
     */
    Route::put('/update/{ricercatore}', [RicercatoreController::class, 'update'])->name('ricercatore.update')->middleware('auth');

    /**
     * Vista per l'elenco dei progetto del ricercatore.
     *
     */
    Route::get('/progetti', [RicercatoreController::class, 'progetti'])->name('ricercatore.progetti')->middleware('auth');
});
/**
 * CRUD per il manager
 */
Route::prefix('manager')->group(function () {

    /**
     * Vista pagina personale di un manager.
     *
     */
    Route::get('/show', [ManagerController::class, 'show'])->name('manager.show')->middleware('auth');

    /**
     * Vista per editare le informazioni di un manager.
     *
     */
    Route::get('/edit/{manager}', [ManagerController::class, 'edit'])->name('manager.edit')->middleware('auth');

    /**
     * Aggiorna le informazioni di un manager.
     *
     */
    Route::put('/update/{manager}', [ManagerController::class, 'update'])->name('manager.update')->middleware('auth');
});
/**
 * CRUD per il finanziatore
 */
Route::prefix('finanziatore')->group(function () {

    /**
     * Vista pagina personale di un finanziatore.
     *
     */
    Route::get('/show', [FinanziatoreController::class, 'show'])->name('finanziatore.show')->middleware('auth');

    /**
     * Vista per editare le informazioni di un finanziatore.
     *
     */
    Route::get('/edit/{finanziatore}', [FinanziatoreController::class, 'edit'])->name('finanziatore.edit')->middleware('auth');

    /**
     * Aggiorna le informazioni di un finanziatore.
     *
     */
    Route::put('/update/{finanziatore}', [FinanziatoreController::class, 'update'])->name('finanziatore.update')->middleware('auth');
});
/**
 * CRUD per il progetto
 */
Route::prefix('progetto')->group(function () {

    /**
     * Vista elenco dei perogetti
     *
     */
    Route::get('/index', [ProgettoController::class, 'index'])->name('progetto.index');

    /**
     * Vista info di un progetto.
     *
     */
    Route::get('/show/{progetto}', [ProgettoController::class, 'show'])->name('progetto.show');

    /**
     * Vista per editare le informazioni di un progetto.
     *
     */
    Route::get('/create', [ProgettoController::class, 'create'])->name('progetto.create')->middleware('auth');

    /**
     * Vista per editare le informazioni di un progetto.
     *
     */
    Route::get('/edit/{progetto}', [ProgettoController::class, 'edit'])->name('progetto.edit')->middleware('auth');

    /**
     * Aggiorna le informazioni di un progetto.
     *
     */
    Route::put('/update/{progetto}', [ProgettoController::class, 'update'])->name('progetto.update')->middleware('auth');

    /**
     * Aggiorna le informazioni di un progetto.
     *
     */
    Route::post('/store', [ProgettoController::class, 'store'])->name('progetto.store')->middleware('auth');

    /**
     * Elimina un progetto.
     *
     */
    Route::delete('/destroy/{progetto}', [ProgettoController::class, 'destroy'])->name('progetto.destroy')->middleware('auth');

    /**
     * Modifica i ricercatori di un progetto.
     *
     */
    Route::get('/{progetto}/edit-ricercatori', [ProgettoController::class, 'editRicercatori'])->name('progetto.edit-ricercatori')->middleware(['auth']);

    /**
     * Rimuove un ricercatore da un progetto.
     *
     */
    Route::delete('/{progetto}/remove-ricercatore/{ricercatore}', [ProgettoController::class, 'removeRicercatore'])->name("progetto.remove-ricercatore")->middleware(['auth']);

    /**
     * Aggiunge un ricercatore a un progetto.
     *
     */
    Route::get("/{progetto}/add-ricercatore", [ProgettoController::class, 'addRicercatore'])->name("progetto.add-ricercatore")->middleware(['auth']);

    /**
     * Salva le modifiche sui ricercatori
     *
     */
    Route::post("/{progetto}/store-ricercatore", [ProgettoController::class, 'storeRicercatore'])->name("progetto.store-ricercatore")->middleware(['auth']);
});
/**
 * CRUD per il sottoprogetto.
 */
Route::prefix('sotto-progetto')->group(function () {

    /**
     * Vista elenco dei sotto progetti.
     *
     */
    Route::get('/index', [SottoProgettoController::class, 'index'])->name('sotto-progetto.index');

    /**
     * Vista info di un sotto progetto.
     *
     */
    Route::get('/show/{sottoProgetto}', [SottoProgettoController::class, 'show'])->name('sotto-progetto.show');

    /**
     * Vista per editare le informazioni di un sotto-progetto.
     *
     */
    Route::get('/create', [SottoProgettoController::class, 'create'])->name('sotto-progetto.create')->middleware('auth', 'ruolo:manager');

    /**
     * Vista per editare le informazioni di una sottoProgetto.
     *
     */
    Route::get('/edit/{sottoProgetto}', [SottoProgettoController::class, 'edit'])->name('sotto-progetto.edit')->middleware('auth', 'ruolo:ricercatore');

    /**
     * Aggiorna le informazioni di una sottoProgetto.
     *
     */
    Route::put('/update/{sottoProgetto}', [SottoProgettoController::class, 'update'])->name('sotto-progetto.update')->middleware('auth', 'ruolo:ricercatore');

    /**
     * Aggiorna le informazioni di una sottoProgetto.
     *
     */
    Route::post('/store', [SottoProgettoController::class, 'store'])->name('sotto-progetto.store')->middleware('auth', 'ruolo:manager');

    /**
     * Elimina una sottoProgetto.
     *
     */
    Route::delete('/destroy/{sottoProgetto}', [SottoProgettoController::class, 'destroy'])->name('sotto-progetto.destroy')->middleware('auth', 'ruolo:manager');

    /**
     * Modifica i ricercatori di una sottoProgetto.
     *
     */
    Route::get('/{sottoProgetto}/edit-ricercatori', [SottoProgettoController::class, 'editRicercatori'])->name('sotto-progetto.edit-ricercatori')->middleware(['auth', 'ruolo:ricercatore']);

    /**
     * Rimuove un ricercatore da un sotto-progetto.
     *
     */
    Route::delete('/{sottoProgetto}/remove-ricercatore/{ricercatore}', [SottoProgettoController::class, 'removeRicercatore'])->name("sotto-progetto.remove-ricercatore")->middleware(['auth', 'ruolo:ricercatore']);

    /**
     * Aggiunge un ricercatore a un sotto-progetto.
     *
     */
    Route::get("/{sottoProgetto}/add-ricercatore", [SottoProgettoController::class, 'addRicercatore'])->name("sotto-progetto.add-ricercatore")->middleware(['auth', 'ruolo:ricercatore']);

    /**
     * Salva le modifiche sui ricercatori
     *
     */
    Route::post("/{sottoProgetto}/store-ricercatore", [SottoProgettoController::class, 'storeRicercatore'])->name("progetto.store-ricercatore")->middleware(['auth', 'ruolo:ricercatore']);
});
/**
 * CRUD per le milestones.
 */
Route::prefix('{sottoProgetto}/milestone')->group(function () {

    /**
     * Vista elenco delle milestone
     *
     */
    Route::get('/index', [MilestoneController::class, 'index'])->name('milestone.index');

    /**
     * Vista info di un progetto.
     *
     */
    Route::get('/show/{milestone}', [MilestoneController::class, 'show'])->name('milestone.show');

    /**
     * Vista per editare le informazioni di un milestone.
     *
     */
    Route::get('/create', [MilestoneController::class, 'create'])->name('milestone.create')->middleware('auth', 'ruolo:ricercatore');

    /**
     * Vista per editare le informazioni di un milestone.
     *
     */
    Route::get('/edit/{milestone}', [MilestoneController::class, 'edit'])->name('milestone.edit')->middleware('auth', 'ruolo:ricercatore');

    /**
     * Aggiorna le informazioni di un progetto.
     *
     */
    Route::put('/update/{milestone}', [MilestoneController::class, 'update'])->name('milestone.update')->middleware('auth', 'ruolo:ricercatore');

    /**
     * Aggiorna le informazioni di una milestone.
     *
     */
    Route::post('/store', [MilestoneController::class, 'store'])->name('milestone.store')->middleware('auth', 'ruolo:ricercatore');

    /**
     * Elimina un milestone.
     *
     */
    Route::delete('/destroy/{milestone}', [MilestoneController::class, 'destroy'])->name('milestone.destroy')->middleware('auth', 'ruolo:ricercatore');
});




Route::prefix('/report')->group(function () {

    /**
     * Vista creazione dei report da un ricercatore.
     *
     */
    Route::get('/create/{progetto}', [ReportController::class, 'create'])->name('report.create')->middleware('auth', 'ruolo:ricercatore');
    /**
     * Creazione dei report da un ricercatore.
     *
     */
    Route::post('/create/{progetto}', [ReportController::class, 'store'])->name('report.store')->middleware('auth', 'ruolo:ricercatore');



    Route::get('/download{file_name}', [ReportController::class, 'download'])->name('report.download');



    /**
     * Eliminazione report da chi l'ha caricato.
     *
     */
    Route::delete('/destroy/{report}/{progetto}', [ReportController::class, 'destroy'])->name('report.destroy')->middleware('auth', 'ruolo:ricercatore');
});


    require __DIR__ . '/auth.php';

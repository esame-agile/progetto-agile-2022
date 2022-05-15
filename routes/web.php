<?php

use App\Http\Controllers\PaginaPersonaleController;
use Illuminate\Support\Facades\Route;

/**
 * Vista home.
 *
 */
Route::get('/', function () {
    $nav = [
        ['label' => 'CHI SIAMO', 'class' => 'page-scroll', 'href' => '#service'],
        ['label' => 'TOP 5', 'class' => 'page-scroll', 'href' => '#testimonial'],
    ];

    return view('home', compact('nav'));
});

/**
 * Elenco ricercatori per un guest.
 *
 */
Route::get('/ricercatori', function () {
    $nav = [['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000']
    ];
    return view('ricercatori', compact('nav'));
});


Route::prefix('pagina-personale')->group(function () {
    /**
     * Vista pagina personale di un ricercatore per i non autenticati.
     *
     */
    //Route::get('/index/{user}', [PaginaPersonaleController::class, 'guest_index'])->name('guest-index');

    /**
     * Vista pagina personale di un ricercatore.
     *
     */
    Route::get('/index', [PaginaPersonaleController::class, 'index'])->name('pagina-personale.index')->middleware('auth');

    /**
     * Vista per editare le informazioni di un ricercatore.
     *
     */
    Route::get('/edit-info/{utente}', [PaginaPersonaleController::class, 'edit_info'])->name('pagina-personale.edit-info')->middleware('auth');

    /**
     * Aggiorna le informazioni di un utente.
     *
     */
    Route::put('/update-info/{utente}', [PaginaPersonaleController::class, 'update_info'])->name('pagina-personale.update-info')->middleware('auth');
});


require __DIR__ . '/auth.php';

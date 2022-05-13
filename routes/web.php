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
 * Vista pagina personale di un ricercatore.
 *
 */
Route::get('/pagina-personale{user}', [PaginaPersonaleController::class, 'guestIndex'])->name('pagina-personale');

Route::get('/pagina-personale', [PaginaPersonaleController::class, 'index'])->name('pagina-personale')->middleware('auth');


/**
 * Vista login.
 *
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

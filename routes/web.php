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
        ['label' => 'LOG IN', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/login']
    ];
    return view('home', compact('nav'));
});

/**
 * Vista pagina personale di un ricercatore.
 *
 */
Route::get('/pagina-personale', [PaginaPersonaleController::class, 'index'])->name('pagina-personale');

/**
 * Vista login.
 *
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

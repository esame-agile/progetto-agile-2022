<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('homE');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $nav = [
        ['label' => 'CHI SIAMO', 'class' => 'page-scroll', 'href' => '#service'],
        ['label' => 'TOP 5', 'class' => 'page-scroll', 'href' => '#testimonial'],
        ['label' => 'LOG IN', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/login']
    ];

    return view('home', compact('nav'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/ricercatori',function (){
    $nav = [ ['label' => 'LOG IN', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/login'],
             ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000']
    ];
    return view('ricercatori', compact('nav'));
});

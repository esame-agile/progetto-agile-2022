<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;

=======
>>>>>>> origin/TS-5_vista_pagina_personale
class PaginaPersonaleController extends Controller
{
    public function index()
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
            ['label' => 'LOG OUT', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/login']
        ];

<<<<<<< HEAD
        $user = Auth::user();

        return view('pagina-personale', compact('nav', 'user'));
=======
        return view('pagina-personale', compact('nav'));
>>>>>>> origin/TS-5_vista_pagina_personale
    }
}

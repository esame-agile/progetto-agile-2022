<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PaginaPersonaleController extends Controller
{
    public function index()
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
            ['label' => 'LOG OUT', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/login']
        ];

        $user = Auth::user();

        return view('pagina-personale', compact('nav', 'user'));
    }
}

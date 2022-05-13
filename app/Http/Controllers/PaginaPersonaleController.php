<?php

namespace App\Http\Controllers;

use App\Models\Utente;
use Illuminate\Support\Facades\Auth;

class PaginaPersonaleController extends Controller
{
    public function index()
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        $user = Auth::user();
        return view('pagina-personale', compact('nav', 'user'));
    }

    public function guestIndex(Utente $user)
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];
        return view('pagina-personale', compact('nav', 'user'));
    }
}

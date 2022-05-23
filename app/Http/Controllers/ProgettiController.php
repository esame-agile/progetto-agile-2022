<?php

namespace App\Http\Controllers;


use App\Models\Progetto;
use Illuminate\Support\Facades\Auth;

class ProgettiController extends Controller
{
    public function index()
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        $progetti = Progetto::all();

        return view('progetti', compact('nav', 'progetti'));
    }
}

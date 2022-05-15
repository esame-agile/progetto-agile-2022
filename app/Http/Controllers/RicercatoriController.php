<?php

namespace App\Http\Controllers;

use App\Models\Ricercatore;

class RicercatoriController extends Controller
{
    public function index()
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        $ricercatori = Ricercatore::all();

        return view('ricercatori', compact('nav', 'ricercatori'));
    }
}

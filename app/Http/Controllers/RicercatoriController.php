<?php

namespace App\Http\Controllers;

use App\Models\Ricercatore;

class RicercatoriController extends Controller
{
    public function index()
    {
        $ricercatori = Ricercatore::all();
        return view('ricercatori', compact( 'ricercatori'));
    }

    public function iMieiProgetti(Ricercatore $utente) {
        $progetti = $utente->progetti()->get();
        //$progetti = Progetto::all();
        return view('ricercatore.progetti', compact( 'progetti'));
    }
}

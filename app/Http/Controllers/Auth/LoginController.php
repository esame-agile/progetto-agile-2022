<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Progetto;

class LoginController extends Controller
{
    public function loginManager()
    {
        $nav = [
            ['label' => 'TUTTI I PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/manager/tuttiprogetti'],
            ['label' => 'CREA PROGETT0', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/manager/creazioneprogetti'],
            //TODO: decommentare quando sarà implementato ['label' => 'GESTIONE PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        $progetti = Progetto::all();

        return view('manager.tutti_progetti',compact('nav', 'progetti'));
    }
    public function loginEnteFinanziatore()
    {
        return view('entefinanziatore.entefinanziatore_successful_access');
    }
    public function loginRicercatore()
    {
        return view('ricercatore.ricercatore_successful_access');
    }
}

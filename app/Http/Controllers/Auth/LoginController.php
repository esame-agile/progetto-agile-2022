<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function loginManager()
    {
        $nav = [
            ['label' => 'TUTTI I PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],

            ['label' => 'CREA PROGETT0', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/manager/creazioneprogetti'],

            ['label' => 'GESTIONE PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],

        ];

        return view('manager.manager_successful_access',compact('nav'));
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

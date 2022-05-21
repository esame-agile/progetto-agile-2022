<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Progetto;

class LoginController extends Controller
{
    public function loginManager()
    {

        $progetti = Progetto::all();

        return view('manager.tutti_progetti',compact( 'progetti'));
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

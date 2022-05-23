<?php

namespace App\Http\Controllers;

use App\Models\Ricercatore;
use Illuminate\Support\Facades\Auth;

class RicercatoreController extends Controller
{
    public function index() {
        $ricercatori = Ricercatore::all();
        return view('ricercatori', compact( 'ricercatori'));
    }




}

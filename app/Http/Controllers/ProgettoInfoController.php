<?php

namespace App\Http\Controllers;

use App\Models\Progetto;

class ProgettoInfoController extends Controller
{
    public function index(Progetto $progetto)
    {
        return view('progetto_info',compact ('progetto'));
    }
}

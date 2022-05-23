<?php

namespace App\Http\Controllers;

use App\Models\Progetto;

class ProgettoInfoController extends Controller
{
    public function index(Progetto $progetto){
        $ricercatori= $progetto->ricercatori()->get();
        $sotto_progetti=$progetto->sotto_progetti()->get();
        return view('progetto_info',compact ('progetto','ricercatori','sotto_progetti'));
    }
}

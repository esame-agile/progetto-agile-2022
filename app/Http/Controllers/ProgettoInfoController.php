<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProgettoInfoController extends Controller
{
    /**
     * @param Progetto $progetto
     * @return Factory|View|Application
     */
    public function index(Progetto $progetto): Factory|View|Application
    {
        $ricercatori= $progetto->ricercatori()->get();
        $sotto_progetti=$progetto->sotto_progetti()->get();
        return view('progetto_info',compact ('progetto','ricercatori','sotto_progetti'));
    }
}

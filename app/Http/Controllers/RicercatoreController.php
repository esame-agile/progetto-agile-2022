<?php

namespace App\Http\Controllers;

use App\Models\Ricercatore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RicercatoreController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $ricercatori = Ricercatore::all();
        return view('ricercatori', compact( 'ricercatori'));
    }




}

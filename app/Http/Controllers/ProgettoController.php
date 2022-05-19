<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Utente;
use Illuminate\Http\Request;

class ProgettoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = [
            ['label' => 'TUTTI I PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/manager/tuttiprogetti'],
            ['label' => 'CREA PROGETT0', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/manager/creazioneprogetti'],
            ['label' => 'GESTIONE PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        $ricercatori = Utente::where('ruolo', '=', 'ricercatore')->get();

        return view('manager.creazione-progetti', compact('nav', 'ricercatori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProgetto(Request $request)
    {
        $nav = [
            ['label' => 'TUTTI I PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/manager/tuttiprogetti'],
            ['label' => 'CREA PROGETT0', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/manager/creazioneprogetti'],
            ['label' => 'GESTIONE PROGETTI', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        $progetto = new Progetto;
        $progetto->titolo = $request->titolo;
        $progetto->descrizione = $request->descrizione;
        $progetto->scopo = $request->scopo;
        $progetto->data_inizio = $request->datainizio;
        $progetto->data_fine = $request->datafine;
        $progetto->responsabile_id = $request->get('selectRes');

        $progetto->save();

        $progetti = Progetto::all();

        return view('manager.tutti_progetti', compact('nav', 'progetti'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function show(Progetto $progetto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function edit(Progetto $progetto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progetto $progetto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progetto $progetto)
    {
        //
    }
}

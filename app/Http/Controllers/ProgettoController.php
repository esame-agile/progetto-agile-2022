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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $ricercatori = Utente::where('ruolo', '=', 'ricercatore')->get();
        return view('manager.creazione-progetti', compact('ricercatori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeProgetto(Request $request)
    {
        $progetto = new Progetto;
        $progetto->titolo = $request->titolo;
        $progetto->descrizione = $request->descrizione;
        $progetto->scopo = $request->scopo;
        $progetto->data_inizio = $request->datainizio;
        $progetto->data_fine = $request->datafine;
        $progetto->responsabile_id = $request->get('selectRes');

        $progetto->save();

        $progetti = Progetto::all();

        return view('manager.tutti_progetti', compact( 'progetti'));

    }

    public function tuttiProgetti() {

        $progetti = Progetto::all();

        return view('manager.tutti_progetti', compact( 'progetti'));

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {

        $ricercatori = Utente::where('ruolo', '=', 'ricercatore')->get();
        $progetto = Progetto::find($id);
        return view('manager.modifica-progetto', compact('progetto', 'ricercatori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $progetto=Progetto::find($id);
        $progetto->update($request->all());

        $progetti = Progetto::all();
        return view('manager.tutti_progetti', compact('progetti'));

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

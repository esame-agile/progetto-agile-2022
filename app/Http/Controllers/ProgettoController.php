<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Ricercatore;
use App\Models\Utente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgettoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $progetti = Progetto::all();

        return view('progetti.index', compact( 'progetti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {

        $progetto = new Progetto;
        $progetto->titolo = $request->titolo;
        $progetto->descrizione = $request->descrizione;
        $progetto->scopo = $request->scopo;
        $progetto->data_inizio = $request->datainizio;
        $progetto->data_fine = $request->datafine;
        $progetto->responsabile()->associate($request->responsabile_id);

        $progetto->save();

        return redirect()->route('progetti.index');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ricercatori = Utente::where('ruolo', '=', 'ricercatore')->get();

        return view('manager.creazione-progetti', compact('ricercatori'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function show(Progetto $progetti)
    {
        $ricercatori=$progetti->ricercatori()->get();
        $sotto_progetti=$progetti->sotto_progetti()->get();
        return view('progetti.show', [
            'progetto'=>$progetti,
            'ricercatori'=>$ricercatori,
            'sotto_progetti'=>$sotto_progetti,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Progetto $progetti)
    {
        $ricercatori = Utente::where('ruolo', '=', 'ricercatore')->get();
        //$progetto = Progetto::find($id);
        return view('manager.modifica-progetto', ["progetto"=>$progetti, "ricercatori"=>$ricercatori]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progetto $progetti)
    {

        $progetti->titolo = $request->titolo;
        $progetti->descrizione = $request->descrizione;
        $progetti->scopo = $request->scopo;
        $progetti->data_inizio = $request->datainizio;
        $progetti->data_fine = $request->datafine;
        $progetti->responsabile()->associate($request->responsabile_id);

        $progetti->save();

        return redirect()->route('progetti.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Progetto  $progetto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progetto $progetti)
    {
        if(Auth::user()->hasRuolo('manager')) {
            $progetti->delete();
            return redirect()->route('progetti.index')->with('success', 'Progetto eliminato con successo');
        } else {
            return redirect()->route('progetti.index')->with('error', 'Non hai i permessi per eliminare un progetto');
        }
    }

    public function mieiprogetti() {

        $utente = Ricercatore::find(Auth::user()->id);
        $progetti = $utente->progetti()->get();
        //$progetti = Progetto::all();
        return view('progetti.index', compact( 'progetti'));
    }

}

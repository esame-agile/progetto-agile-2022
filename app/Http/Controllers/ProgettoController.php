<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Ricercatore;
use App\Models\Utente;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Modifica dei ricercatori associati al sottoprogetto
     * @param Progetto $progetto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function editRicercatori(Progetto $progetto)
    {
        if (Auth::user()->hasRuolo('responsabile') && Auth::user()->id == $progetto->responsabile_id )
        {
            $ricercatori = $progetto->ricercatori()->paginate(10);
            return view('progetti.edit_ricercatori', compact('progetto', 'ricercatori'));
        }
        return redirect()->route('progetti.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Ritorno la vista se si possiede la giusta autenticazione
     * @param Progetto $progetto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function addRicercatoreView(Progetto $progetto)
    {
        if (Auth::user()->id == $progetto->responsabile_id )
        {
            $ricercatori = Ricercatore::all()->except($progetto->ricercatori()->pluck('utenti.id')->toArray());
            return view('progetti.add_ricercatore', compact('progetto', 'ricercatori'));
        }
        return redirect()->route('progetti.edit_ricercatori', compact("progetto"))->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Aggiungo un ricercatore al progetto
     * @param Request $request
     * @param Progetto $progetto
     * @return RedirectResponse
     */
    public function addRicercatore(Request $request, Progetto $progetto)
    {
        if (Auth::user()->id == $progetto->responsabile_id )
        {
            $ricercatore = Ricercatore::find($request->ricercatore_id);
            if($ricercatore == null){
                return redirect()->route('progetti.edit_ricercatori', $progetto)->with('error', 'Ricercatore non trovato');
            }
            if($progetto->ricercatori()->where('ricercatore_id', $ricercatore->id)->first() != null){
                return redirect()->route('progetti.edit_ricercatori', $progetto)->with('error', 'Ricercatore già associato');
            }
            $progetto->ricercatori()->attach($ricercatore);
            return redirect()->route('progetti.edit_ricercatori', $progetto)->with('success', 'Ricercatore aggiunto con successo');
        }
        return redirect()->route('progetti.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Rimozione dei ricercatori associati al sottoprogetto
     * @param Progetto $progetto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function removeRicercatore(Progetto $progetto, Ricercatore $ricercatore)
    {
        if (Auth::user()->id == $progetto->responsabile_id ) {
            if ($progetto->ricercatori()->where('ricercatore_id', $ricercatore->id)->first() == null) {
                return redirect()->route('progetti.edit_ricercatori', $progetto)->with('error', 'Ricercatore non associato');
            }
            $progetto->ricercatori()->detach($ricercatore);
            return redirect()->route('progetti.edit_ricercatori', $progetto->id)->with('success', 'Ricercatore rimosso con successo');
        }
        return redirect()->route('progetti.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }



}

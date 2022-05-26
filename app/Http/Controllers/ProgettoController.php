<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Ricercatore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Utente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgettoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $progetti = Progetto::all();

        return view('progetti.index', compact('progetti'));
    }

    /**
     * Display the specified resource.
     *
     * @param Progetto $progetto
     * @return Application|Factory|View
     */
    public function show(Progetto $progetto): View|Factory|Application
    {
        $ricercatori = $progetto->ricercatori()->get();
        $sotto_progetti = $progetto->sotto_progetti()->get();
        return view('progetti.show', compact('progetto', 'ricercatori', 'sotto_progetti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $ricercatori = Ricercatore::all();
        return view('manager.creazione-progetti', compact('ricercatori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Progetto $progetto
     * @return Application|Factory|View
     */
    public function edit(Progetto $progetto): View|Factory|Application
    {
        $ricercatori = Ricercatore::all();
        return view('manager.modifica-progetti', compact('progetto', 'ricercatori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Progetto $progetto
     * @return RedirectResponse
     */
    public function update(Request $request, Progetto $progetto): RedirectResponse
    {
        $this->setProjectParameters($request, $progetto);
        return redirect()->route('progetti.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $progetto = new Progetto;
        $this->setProjectParameters($request, $progetto);
        return redirect()->route('progetti.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Progetto $progetti
     * @return RedirectResponse
     */
    public function destroy(Progetto $progetti): RedirectResponse
    {
        if (Auth::user()->hasRuolo('manager')) {
            $progetti->delete();
            return redirect()->route('progetti.index')->with('success', 'Progetto eliminato con successo');
        } else {
            return redirect()->route('progetti.index')->with('error', 'Non hai i permessi per eliminare un progetto');
        }
    }

    /**
     * @return Factory|View|Application
     */
    public function mieiProgetti(): Factory|View|Application
    {
        $progetti = Ricercatore::find(Auth::user()->id)->progetti()->get();
        return view('progetti.index', compact('progetti'));
    }

    /**
     * @param Request $request
     * @param Progetto $progetto
     * @return Progetto
     */
    public function setProjectParameters(Request $request, Progetto $progetto): Progetto
    {
        $progetto->titolo = $request->titolo;
        $progetto->descrizione = $request->descrizione;
        $progetto->scopo = $request->scopo;
        $progetto->data_inizio = $request->datainizio;
        $progetto->data_fine = $request->datafine;
        $progetto->budget = $request->budget;
        $progetto->responsabile()->associate($request->responsabile_id);

        $progetto->save();

        return $progetto;
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

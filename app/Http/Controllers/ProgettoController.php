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
        return view('progetto.index', compact('progetti'));
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
        $reports = $progetto->reports()->get();
        return view('progetto.show', compact('progetto', 'ricercatori', 'sotto_progetti', 'reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $ricercatori = Ricercatore::all();
        return view('progetto.create', compact('ricercatori'));
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
        return view('progetto.edit', compact('progetto', 'ricercatori'));
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
        return redirect()->route('progetto.index');
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
        return redirect()->route('progetto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Progetto $progettof
     * @return RedirectResponse
     */
    public function destroy(Progetto $progetto): RedirectResponse
    {
        if (Auth::user()->hasRuolo('manager')) {
            $progetto->delete();
            return redirect()->route('progetto.index')->with('success', 'Progetto eliminato con successo');
        } else {
            return redirect()->route('progetto.index')->with('error', 'Non hai i permessi per eliminare un progetto');
        }
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
     * @return Application|Factory|View|RedirectResponse
     */
    public function editRicercatori(Progetto $progetto): View|Factory|RedirectResponse|Application
    {
        if (Auth::user()->id == $progetto->responsabile_id )
        {
            $ricercatori = $progetto->ricercatori()->paginate(10);
            return view('progetto.edit-ricercatori', compact('progetto', 'ricercatori'));
        }
        return redirect()->route('progetto.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Ritorno la vista se si possiede la giusta autenticazione
     * @param Progetto $progetto
     * @return Application|Factory|View|RedirectResponse
     */
    public function addRicercatore(Progetto $progetto): View|Factory|RedirectResponse|Application
    {
        if (Auth::user()->id == $progetto->responsabile_id )
        {
            $ricercatori = Ricercatore::all()->except($progetto->ricercatori()->pluck('utenti.id')->toArray());
            return view('progetto.add-ricercatore', compact('progetto', 'ricercatori'));
        }
        return redirect()->route('progetto.edit-ricercatori', compact("progetto"))->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Aggiungo un ricercatore al progetto
     * @param Request $request
     * @param Progetto $progetto
     * @return RedirectResponse
     */
    public function storeRicercatore(Request $request, Progetto $progetto): RedirectResponse
    {
        if (Auth::user()->id == $progetto->responsabile_id )
        {
            $ricercatore = Ricercatore::find($request->ricercatore_id);
            if($ricercatore == null){
                return redirect()->route('progetto.edit-ricercatori', $progetto)->with('error', 'Ricercatore non trovato');
            }
            if($progetto->ricercatori()->where('ricercatore_id', $ricercatore->id)->first() != null){
                return redirect()->route('progetto.edit-ricercatori', $progetto)->with('error', 'Ricercatore già associato');
            }
            $progetto->ricercatori()->attach($ricercatore);
            return redirect()->route('progetto.edit-ricercatori', $progetto)->with('success', 'Ricercatore aggiunto con successo');
        }
        return redirect()->route('progetto.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Rimozione dei ricercatori associati al sottoprogetto
     * @param Progetto $progetto
     * @param Ricercatore $ricercatore
     * @return RedirectResponse
     */
    public function removeRicercatore(Progetto $progetto, Ricercatore $ricercatore): RedirectResponse
    {
        if (Auth::user()->id == $progetto->responsabile_id ) {
            if ($progetto->ricercatori()->where('ricercatore_id', $ricercatore->id)->first() == null) {
                return redirect()->route('progetto.edit-ricercatori', $progetto)->with('error', 'Ricercatore non associato');
            }
            $progetto->ricercatori()->detach($ricercatore);
            return redirect()->route('progetto.edit-ricercatori', $progetto->id)->with('success', 'Ricercatore rimosso con successo');
        }
        return redirect()->route('progetto.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }



}

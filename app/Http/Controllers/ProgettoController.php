<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Ricercatore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        $progetti = Progetto::paginate(10);
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
        $ricercatori = $progetto->ricercatori()->paginate(10);
        $sottoProgetti = $progetto->sotto_progetti()->paginate(10);
        $reports = $progetto->reports()->paginate(10);
        $pubblicazioni = $progetto->pubblicazioni()->paginate(10);
        return view('progetto.show', compact('progetto', 'ricercatori', 'sottoProgetti', 'reports', 'pubblicazioni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $ricercatori = Ricercatore::paginate(10);
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
        $ricercatori = Ricercatore::paginate(10);
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
        return redirect()->route('progetto.index')->with('success', 'Progetto aggiornato con successo');
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
        return redirect()->route('progetto.index')->with('success', 'Progetto creato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Progetto $progetto
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
        $request->validate([
            'titolo' => 'required|max:255',
            'descrizione' => 'required|max:255',
            'scopo' => 'required|max:255',
            'data_inizio' => 'required|date',
            'data_fine' => 'required|date',
            'budget' => 'required|numeric',
            'responsabile_id' => 'required|numeric',
        ]);

        $progetto->titolo = $request->titolo;
        $progetto->descrizione = $request->descrizione;
        $progetto->scopo = $request->scopo;
        $progetto->data_inizio = $request->data_inizio;
        $progetto->data_fine = $request->data_fine;
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
            $ricercatori_add = Ricercatore::all()->except($progetto->ricercatori()->pluck('utenti.id')->toArray());
            return view('progetto.edit-ricercatori', compact('progetto', 'ricercatori', 'ricercatori_add'));
        }
        return redirect()->route('progetto.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
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
            $ricercatori = $request->ricercatori;
            if($ricercatori == null)
            {
                return redirect()->route('progetto.edit-ricercatori', $progetto)->with('error', 'Nessun ricercatore selezionato');
            }
            foreach ($ricercatori as $ricercatore)
            {
                $progetto->ricercatori()->attach($ricercatore);
            }
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

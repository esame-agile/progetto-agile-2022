<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SottoProgettoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|Factory|RedirectResponse|Application
     */
    public function index(Request $request): View|Factory|RedirectResponse|Application
    {
        if ($request->query('progetto')) {
            $sottoProgetti = SottoProgetto::where('progetto_id', $request->query('progetto'))->paginate(10);
        } else {
            $sottoProgetti = SottoProgetto::paginate(10);
        }
        if ( $sottoProgetti == null || $sottoProgetti->isEmpty()) {
            return view('sotto-progetto.index', compact('sottoProgetti'))->with('error', 'Non ci sono sotto progetti');
        }
        return view('sotto-progetto.index', compact('sottoProgetti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(): View|Factory|RedirectResponse|Application
    {
        $ricercatori = Ricercatore::all();
        $progetti = Progetto::all();

        if (Auth::user()->hasRuolo('manager')) {
            return view('sotto-progetto.create', compact('ricercatori', 'progetti'));
        }
        return redirect()->route('sotto-progetto.index')->with('error', 'Non hai i permessi per creare un sotto progetto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::user()->hasRuolo("manager")) {
            return redirect()->route('sotto-progetto.index')->with('error', 'Non hai i permessi per creare un sotto progetto');
        }
        $sottoProgetto = new SottoProgetto();
        $sottoProgetto = $this->sottoProgettoFill($request, $sottoProgetto);
        return redirect()->route('sotto-progetto.show', compact('sottoProgetto'))->with('success', 'Sotto progetto creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param SottoProgetto $sottoProgetto
     * @return Application|Factory|View
     */
    public function show(SottoProgetto $sottoProgetto): View|Factory|Application
    {
        $ricercatori = $sottoProgetto->ricercatori()->paginate(10);
        $milestones = $sottoProgetto->milestones()->paginate(10);
        $progetto = $sottoProgetto->progetto()->first();
        return view('sotto-progetto.show', compact('sottoProgetto', 'ricercatori', 'milestones', 'progetto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SottoProgetto $sottoProgetto
     * @return View|Factory|RedirectResponse
     */
    public function edit(SottoProgetto $sottoProgetto): View|Factory|RedirectResponse
    {
        $ricercatori = Ricercatore::all();

        if (Auth::user()->hasRuolo('manager')) {
            return view('sotto-progetto.edit', compact('ricercatori','sottoProgetto'));
        }
        return redirect()->route('sotto-progetto.index')->with('error', 'Non hai i permessi per modificare un sotto progetto');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SottoProgetto $sottoProgetto
     * @return RedirectResponse
     */
    public function update(Request $request, SottoProgetto $sottoProgetto): RedirectResponse
    {
        if (Auth::user()->hasRuolo('manager')) {
            $sottoProgetto = $this->sottoProgettoFill($request, $sottoProgetto);
            return redirect()->route('sotto-progetto.show', compact('sottoProgetto'))->with('success', 'Sotto progetto modificato con successo');
        }
        return redirect()->route('sotto-progetto.show', compact('sottoProgetto'))->with('error', 'Non hai i permessi per modificare un sottoprogetto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SottoProgetto $sottoProgetto
     * @return RedirectResponse
     */
    public function destroy(SottoProgetto $sottoProgetto): RedirectResponse
    {
        if (Auth::user()->hasRuolo('manager')) {
            $sottoProgetto->delete();
            return redirect()->route('sotto-progetto.index')->with('success', 'Sotto progetto eliminato con successo');
        } else {
            return redirect()->route('sotto-progetto.index')->with('error', 'Non hai i permessi per eliminare un sotto progetto');
        }
    }

    /**
     * Modifica dei ricercatori associati al sottoprogetto
     * @param SottoProgetto $sottoProgetto
     * @return Application|Factory|View|RedirectResponse
     */
    public function editRicercatori(SottoProgetto $sottoProgetto): View|Factory|RedirectResponse|Application
    {
        if (Auth::user()->id == $sottoProgetto->responsabile_id) {
            $ricercatori = $sottoProgetto->ricercatori()->paginate(10);
            $ricercatori_add = Ricercatore::all()->except($sottoProgetto->ricercatori()->pluck('utenti.id')->toArray());
            return view('sotto-progetto.edit-ricercatori', compact('sottoProgetto', 'ricercatori', 'ricercatori_add'));
        }
        return redirect()->route('sotto-progetto.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Aggiungere dei ricercatori al sottoprogetto
     * @param Request $request
     * @param SottoProgetto $sottoProgetto
     * @return RedirectResponse
     */
    public function storeRicercatore(Request $request, SottoProgetto $sottoProgetto): RedirectResponse
    {
        if (Auth::user()->id == $sottoProgetto->responsabile_id )
        {
            $ricercatori = $request->ricercatori;
            if($ricercatori == null)
            {
                return redirect()->route('progetto.edit-ricercatori', $sottoProgetto)->with('error', 'Nessun ricercatore selezionato');
            }
            foreach ($ricercatori as $ricercatore)
            {
                $sottoProgetto->ricercatori()->attach($ricercatore);
            }
            return redirect()->route('progetto.edit-ricercatori', $sottoProgetto)->with('success', 'Ricercatore aggiunto con successo');
        }
        return redirect()->route('progetto.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Rimozione dei ricercatori associati al sottoprogetto
     * @param SottoProgetto $sottoProgetto
     * @param Ricercatore $ricercatore
     * @return RedirectResponse
     */
    public function removeRicercatore(SottoProgetto $sottoProgetto, Ricercatore $ricercatore): RedirectResponse
    {
        if (Auth::user()->id == $sottoProgetto->responsabile_id) {
            if ($sottoProgetto->ricercatori()->where('ricercatore_id', $ricercatore->id)->first() == null) {
                return redirect()->route('sotto-progetto.edit-ricercatori', $sottoProgetto)->with('error', 'Ricercatore non associato');
            }
            $sottoProgetto->ricercatori()->detach($ricercatore);
            return redirect()->route('sotto-progetto.edit-ricercatori', $sottoProgetto->id)->with('success', 'Ricercatore rimosso con successo');
        }
        return redirect()->route('sotto-progetto.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * @param Request $request
     * @param SottoProgetto $sottoProgetto
     * @return SottoProgetto
     */
    public function sottoProgettoFill(Request $request, SottoProgetto $sottoProgetto): SottoProgetto
    {
        $request->validate([
            'titolo' => 'required|max:255|min:3',
            'descrizione' => 'required|max:255|min:3',
            'data_rilascio' => 'required|date',
            'responsabile_id' => 'required|integer',
            'progetto_id' => 'required|integer',
        ]);


        $sottoProgetto->titolo = $request->titolo;
        $sottoProgetto->descrizione = $request->descrizione;
        $sottoProgetto->data_rilascio = $request->data_rilascio;
        $sottoProgetto->progetto()->associate($request->progetto_id);
        $sottoProgetto->responsabile()->associate($request->responsabile_id);
        $sottoProgetto->save();

        return $sottoProgetto;
    }
}

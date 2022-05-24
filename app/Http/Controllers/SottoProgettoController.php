<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Progetto;
use App\Models\Responsabile;
use App\Models\Ricercatore;
use App\Models\SottoProgetto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SottoProgettoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->query('progetto')){
            $sottoProgetti = SottoProgetto::where('progetto_id', $request->query('progetto'))->paginate(10);
        }
        else {
            if (Auth::user()->hasRuolo('manager')) {
                $sottoProgetti = SottoProgetto::where("id", ">", 0)->paginate(10);
            } elseif (Auth::user()->hasRuolo('responsabile')) {
                $sottoProgetti = Auth::user()->sotto_progetti()->paginate(10);
            } elseif (Auth::user()->hasRuolo('ricercatore')) {
                $sottoProgetti = Auth::user()->sotto_progetti()->paginate(10);
            }
        }
        if ($sottoProgetti->isEmpty()) {
            return view('sottoprogetti.index', ['sottoProgetti' => $sottoProgetti])->with('error', 'Non ci sono sottoprogetti');
        }
        return view('sottoprogetti.index', compact('sottoProgetti'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function create()
    {
        $responsabili = Responsabile::all()->merge(Ricercatore::all());
        $progetti = Progetto::all();

        if (Auth::user()->hasRuolo('manager')) {
            return view('sottoprogetti.create', compact('responsabili', 'progetti'));
        }
        return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per creare un sottoprogetto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasRuolo("manager")){
            return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per creare un sottoprogetto');
        }
        $sottoProgetto = new SottoProgetto();
        return $this->sottoProgettoFill($request, $sottoProgetto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SottoProgetto  $sottoprogetti
     * @return \Illuminate\Http\Response
     */
    public function show(SottoProgetto $sottoprogetti)
    {
        return view('sottoprogetti.show', compact('sottoprogetti'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SottoProgetto  $sottoprogetti
     * @return \Illuminate\Http\Response
     */
    public function edit(SottoProgetto $sottoprogetti)
    {
        $responsabili = Responsabile::all()->merge(Ricercatore::all());

        if (Auth::user()->hasRuolo('manager')) {
            return view('sottoprogetti.edit', compact('sottoprogetti', 'responsabili'));
        }
        return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per modificare un sottoprogetto');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SottoProgetto  $sottoprogetti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SottoProgetto $sottoprogetti)
    {
        if (Auth::user()->hasRuolo('manager')) {
            return $this->sottoProgettoFill($request, $sottoprogetti);
        }
        return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per modificare un sottoprogetto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SottoProgetto  $sottoprogetti
     * @return \Illuminate\Http\Response
     */
    public function destroy(SottoProgetto $sottoprogetti)
    {
        if(Auth::user()->hasRuolo('manager')) {
            $sottoprogetti->delete();
            return redirect()->route('sottoprogetti.index')->with('success', 'Sottoprogetto eliminato con successo');
        } else {
            return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per eliminare un sottoprogetto');
        }
    }

    /**
     * Modifica dei ricercatori associati al sottoprogetto
     * @param SottoProgetto $sottoprogetti
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function editRicercatori(SottoProgetto $sottoProgetto)
    {
        if (Auth::user()->hasRuolo('responsabile') && Auth::user()->id == $sottoProgetto->responsabile_id )
        {
            $ricercatori = $sottoProgetto->ricercatori()->paginate(10);
            return view('sottoprogetti.edit_ricercatori', compact('sottoProgetto', 'ricercatori'));
        }
        return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    public function addRicercatoreView(SottoProgetto $sottoProgetto)
    {
        if (Auth::user()->hasRuolo('responsabile') && Auth::user()->id == $sottoProgetto->responsabile_id )
        {
            $ricercatori = Ricercatore::all();
            return view('sottoprogetti.add_ricercatore', compact('sottoProgetto', 'ricercatori'));
        }
        return redirect()->route('sottoprogetti.edit_ricercatori', compact("sottoProgetto"))->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    public function addRicercatore(Request $request, SottoProgetto $sottoProgetto)
    {
        if (Auth::user()->hasRuolo('responsabile') && Auth::user()->id == $sottoProgetto->responsabile_id )
        {
            $ricercatore = Ricercatore::find($request->ricercatore_id);
            if($ricercatore == null){
                return redirect()->route('sottoprogetti.edit_ricercatori', $sottoProgetto)->with('error', 'Ricercatore non trovato');
            }
            if($sottoProgetto->ricercatori()->where('ricercatore_id', $ricercatore->id)->first() != null){
                return redirect()->route('sottoprogetti.edit_ricercatori', $sottoProgetto)->with('error', 'Ricercatore già associato');
            }
            $sottoProgetto->ricercatori()->attach($ricercatore);
            return redirect()->route('sottoprogetti.edit_ricercatori', $sottoProgetto)->with('success', 'Ricercatore aggiunto con successo');
        }
        return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * Rimozione dei ricercatori associati al sottoprogetto
     * @param SottoProgetto $sottoProgetto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function removeRicercatore(SottoProgetto $sottoProgetto, Ricercatore $ricercatore)
    {
        if (Auth::user()->hasRuolo('responsabile') && Auth::user()->id == $sottoProgetto->responsabile_id ) {
            if ($sottoProgetto->ricercatori()->where('ricercatore_id', $ricercatore->id)->first() == null) {
                return redirect()->route('sottoprogetti.edit_ricercatori', $sottoProgetto)->with('error', 'Ricercatore non associato');
            }
            $sottoProgetto->ricercatori()->detach($ricercatore);
            return redirect()->route('sottoprogetti.edit_ricercatori', $sottoProgetto->id)->with('success', 'Ricercatore rimosso con successo');
        }
        return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }


    /**
     * @param Request $request
     * @param SottoProgetto $sottoProgetto
     * @return RedirectResponse
     */
    public function sottoProgettoFill(Request $request, SottoProgetto $sottoProgetto)
    {
        $request->validate([
            'titolo' => 'required|max:255|min:3',
            'descrizione' => 'required|max:255|min:3',
            'data_rilascio' => 'required|date',
            'responsabile_id' => 'required|integer',
            'progetto_id' => 'required|integer',
        ]);

        $ric = Ricercatore::find($request->responsabile_id);
        if($ric){
            $ric->ruolo = 'responsabile';
            $ric->save();
        }

        $sottoProgetto->titolo = $request->titolo;
        $sottoProgetto->descrizione = $request->descrizione;
        $sottoProgetto->data_rilascio = $request->data_rilascio;
        $sottoProgetto->progetto()->associate($request->progetto_id);
        $sottoProgetto->responsabile()->associate($request->responsabile_id);
        $sottoProgetto->save();
        return redirect()->route('sottoprogetti.index');
    }
}

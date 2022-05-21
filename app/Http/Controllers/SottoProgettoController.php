<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
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
    public function index()
    {
        if (Auth::user()->hasRuolo('manager')) {
            $sottoProgetti = SottoProgetto::paginate(10);
        } else {
            $sottoProgetti = SottoProgetto::where('responsabile_id', Auth::user()->id)->paginate(10);
        }
        if ($sottoProgetti == null) {
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
        if (Auth::user()->hasRuolo('manager')) {
            $sottoProgetti = SottoProgetto::all();
            return view('sottoprogetti.create', compact('sottoProgetti'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SottoProgetto  $sottoProgetto
     * @return \Illuminate\Http\Response
     */
    public function show(SottoProgetto $sottoProgetto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SottoProgetto  $sottoProgetto
     * @return \Illuminate\Http\Response
     */
    public function edit(SottoProgetto $sottoProgetto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SottoProgetto  $sottoProgetto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SottoProgetto $sottoProgetto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SottoProgetto  $sottoProgetto
     * @return \Illuminate\Http\Response
     */
    public function destroy(SottoProgetto $sottoProgetto)
    {
        //
    }

    /**
     * Modifica dei ricercatori associati al sottoprogetto
     * @param SottoProgetto $sottoProgetto
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function editRicercatori(SottoProgetto $sottoProgetto)
    {
        if (Auth::user()->hasRuolo('responsabile') && Auth::user()->id == $sottoProgetto->responsabile_id ) {
            $ricercatori = $sottoProgetto->ricercatori()->paginate(10);
            return view('sottoprogetti.edit_ricercatori', compact('sottoProgetto', 'ricercatori'));
        }
        return redirect()->route('sottoprogetti.index')->with('error', 'Non hai i permessi per modificare i ricercatori');
    }

    /**
     * @param Request $request
     * @param SottoProgetto $sottoProgetto
     * @return RedirectResponse
     */
    public function sottoProgettoFill(Request $request, SottoProgetto $sottoProgetto): RedirectResponse
    {
        $request->validate([
            'titolo' => 'required|max:255|min:3',
            'descrizione' => 'required|max:255|min:3',
            'data_evento' => 'required|date',
            'responsabile_id' => 'required|integer',
            'progetto_id' => 'required|integer',
        ]);

        $sottoProgetto->titolo = $request->titolo;
        $sottoProgetto->descrizione = $request->descrizione;
        $sottoProgetto->data_rilascio = $request->data_rilascio;
        $sottoProgetto->progetto()->associate($request->progetto_id);
        $sottoProgetto->responsabile()->associate($request->responsabile_id);
        $sottoProgetto->save();

        return redirect()->route('sottoprogetti.index');
    }
}

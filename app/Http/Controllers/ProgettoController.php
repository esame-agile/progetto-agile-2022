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
    public function index()
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
    public function show(Progetto $progetto)
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
    public function create()
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
    public function edit(Progetto $progetto)
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
    public function update(Request $request, Progetto $progetto)
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
    public function store(Request $request)
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

}

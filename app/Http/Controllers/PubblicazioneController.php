<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Pubblicazione;
use App\Models\Ricercatore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Utente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PubblicazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

   /* public function show(Progetto $progetto): View|Factory|Application
    {
        $ricercatori = $progetto->ricercatori()->get();
        $sotto_progetti = $progetto->sotto_progetti()->get();
        return view('progetto.show', compact('progetto', 'ricercatori', 'sotto_progetti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Ricercatore $ricercatore): View|Factory|Application
    {
        $progetti = $ricercatore->progetti()->get();
        $ricercatori=Ricercatore::all();
        return view('pubblicazioni.create', compact('progetti','ricercatori','ricercatore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Progetto $progetto
     * @return Application|Factory|View
     */
    public function edit(Ricercatore $ricercatore): View|Factory|Application
    {
        $pubblicazioniF = $ricercatore->pubblicazioni()->where('ufficiale', '=','0')->get();
        $pubblicazioniT = $ricercatore->pubblicazioni()->where('ufficiale', '=','1')->get();
        return view('pubblicazioni.edit', compact('pubblicazioniF','pubblicazioniT'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Progetto $progetto
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $this->setVisibilitaPubblicazioni($request);
        return redirect()->route('ricercatore.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $pubblicazione = new Pubblicazione();
        $this->setProjectParameters($request, $pubblicazione);
        return redirect()->route('ricercatore.show');
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
    public function setProjectParameters(Request $request, Pubblicazione $pubblicazione): Pubblicazione
    {
        $pubblicazione->doi = $request->doi;
        $pubblicazione->titolo = $request->titolo;
        $pubblicazione->autori_esterni = $request->autori_esterni;
        $pubblicazione->tipologia = $request->tipologia;
        $pubblicazione->progetto()->associate($request->progetto_id);

        $pubblicazione->save();
        foreach ($request->ricercatori as $ricercatore_id) {
            $ricercatore=Ricercatore::find($ricercatore_id);
            $pubblicazione->ricercatore()->attach($ricercatore);
        }
        return $pubblicazione;
    }
    public function setVisibilitaPubblicazioni(Request $request)
    {
        if($request->pubblicazioniT!=null) {
            foreach ($request->pubblicazioniT as $pubblicazioneT_id) {
                $pubblicazioneT = Pubblicazione::find($pubblicazioneT_id);
                $pubblicazioneT->ufficiale = false;
                $pubblicazioneT->save();
            }
        }
        if($request->pubblicazioniF!=null) {
            foreach ($request->pubblicazioniF as $pubblicazioneF_id) {
                $pubblicazioneF = Pubblicazione::find($pubblicazioneF_id);
                $pubblicazioneF->ufficiale = true;
                $pubblicazioneF->save();
            }
        }
        return 0;

    }





}

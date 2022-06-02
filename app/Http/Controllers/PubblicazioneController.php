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

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Ricercatore $ricercatore): View|Factory|Application
    {
        $progetti = $ricercatore->progetti()->paginate(10);
        $ricercatori = Ricercatore::paginate(10);
        return view('pubblicazioni.create', compact('progetti','ricercatori','ricercatore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit(Progetto $progetto): View|Factory|Application
    {

        $pubblicazioniF = $progetto->pubblicazioni()->where('ufficiale', '=','0')->get();
        $pubblicazioniT = $progetto->pubblicazioni()->where('ufficiale', '=','1')->get();
        return view('pubblicazioni.edit', compact('pubblicazioniF','pubblicazioniT','progetto'));
    }

    /**
     * Update the specified resource in storage.
     *

     */
    public function update(Request $request, Progetto $progetto): RedirectResponse
    {
        $this->setVisibilitaPubblicazioni($request);
        return redirect()->route('progetto.show',$progetto);
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
        $this->pubblicazioneFill($request, $pubblicazione);
        return redirect()->route('ricercatore.show');
    }

    /**
     * @param Request $request
     * @param Pubblicazione $pubblicazione
     * @return Pubblicazione
     */
    public function pubblicazioneFill(Request $request, Pubblicazione $pubblicazione): Pubblicazione
    {
        $request->validate([
            'doi' => 'required|max:255|min:3',
            'titolo' => 'required|max:255|min:3',
            'autori_esterni' => 'required|max:255|min:3',
            'tipologia' => 'required|max:255|min:3',
            'progetto_id' => 'required|integer',
        ]);
        $pubblicazione->doi = $request->doi;
        $pubblicazione->titolo = $request->titolo;
        $pubblicazione->autori_esterni = $request->autori_esterni;
        $pubblicazione->tipologia = $request->tipologia;
        $pubblicazione->progetto()->associate($request->progetto_id);
        $file=$request->file_name;
        $filename=time().'.'.$file->extension();
        $request->file_name->move('assets', $filename);
        $pubblicazione->file_name=$filename;
        $pubblicazione->save();
        foreach ($request->ricercatori as $ricercatore_id) {
            $ricercatore=Ricercatore::find($ricercatore_id);
            $pubblicazione->ricercatore()->attach($ricercatore);
        }

        return $pubblicazione;
    }
    public function download(Request $request, $file_name) {

        return response()->download(public_path('assets/'.$file_name));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param Pubblicazione $pubblicazione
     * @return RedirectResponse
     */
    public function destroy(Pubblicazione $pubblicazione): RedirectResponse
    {
        if (Auth::user()->hasRuolo('ricercatore')) {
            $pubblicazione->delete();
            return redirect()->route('ricercatore.show')->with('success', 'Pubblicazione eliminata con successo');
        } else {
            return redirect()->route('ricercatore.show')->with('error', 'Non hai i permessi per eliminare questa pubblicazione');
        }
    }



}

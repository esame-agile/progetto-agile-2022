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
     * @param Pubblicazione $pubblicazione
     * @return View|Factory|Application
     */
    public function show(Pubblicazione $pubblicazione): View|Factory|Application
    {
        $autori = $pubblicazione->ricercatori()->paginate(10);
        return view('pubblicazioni.show', compact('pubblicazione', 'autori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $autore = Ricercatore::find(Auth::user()->id);
        $progetti = $autore->progetti()->paginate(10);
        $ricercatori = Ricercatore::all();
        return view('pubblicazioni.create', compact('progetti', 'ricercatori', 'autore'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Pubblicazione $pubblicazione): RedirectResponse
    {
        $this->setVisibilitaPubblicazioni($request, $pubblicazione);
        $progetto = $pubblicazione->progetto()->first();
        return redirect()->route('progetto.show', compact('progetto'))->with('success', 'Pubblicazioni aggiornate con successo');
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
            'file_name' => 'required',
            'tipologia' => 'required|max:255|min:3',
            'progetto_id' => 'required|integer',
        ]);

        $pubblicazione->doi = $request->doi;
        $pubblicazione->titolo = $request->titolo;
        $pubblicazione->autori_esterni = $request->autori_esterni;
        $pubblicazione->tipologia = $request->tipologia;
        $pubblicazione->progetto()->associate($request->progetto_id);
        $file = $request->file_name;
        $filename = time() . '.' . $file->extension();
        $request->file_name->move('assets', $filename);
        $pubblicazione->file_name = $filename;
        $pubblicazione->save();
        foreach ($request->ricercatori as $ricercatore_id) {
            $ricercatore = Ricercatore::find($ricercatore_id);
            $ricercatore->pubblicazioni()->attach($pubblicazione->id);
        }

        return $pubblicazione;
    }

    public function download(Request $request, $file_name)
    {
        return response()->download(public_path('assets/' . $file_name));
    }

    public function setVisibilitaPubblicazioni(Request $request, Pubblicazione $pubblicazione): void
    {
        if ($request->visibilita == 1) {
            Pubblicazione::find($pubblicazione->id)->update(['ufficiale' => true]);
        } else {
            Pubblicazione::find($pubblicazione->id)->update(['ufficiale' => false]);
        }
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

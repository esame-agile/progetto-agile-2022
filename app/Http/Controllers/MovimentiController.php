<?php

namespace App\Http\Controllers;

use App\Models\Movimento;
use App\Models\Progetto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimentiController extends Controller
{
    /**
     * @param Progetto $progetto
     * @return Factory|View|Application
     */
    public function index(Progetto $progetto): Factory|View|Application
    {
        if(Auth::user()->id == $progetto->responsabile_id){
            $movimenti = $progetto->movimenti()->paginate(10);
        } else {
            $movimenti = $progetto->movimenti()->where('approvazione', '!=', 0)->paginate(10);
        }
        return view('movimento.index', compact('movimenti', 'progetto'));
    }

    /**
     * @param Progetto $progetto
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(Progetto $progetto): View|Factory|RedirectResponse|Application
    {
        if (Auth::user()->hasRuolo('ricercatore') && $progetto->ricercatori()->where('ricercatore_id', Auth::user()->id)->exists() ||
            Auth::user()->hasRuolo('finanziatore') || Auth::user()->id == $progetto->responsabile_id) {

            return view('movimento.create', compact('progetto'));
        }
        return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non hai i permessi per creare un movimento');
    }

    /**
     * @param Request $request
     * @param Progetto $progetto
     * @return RedirectResponse
     */
    public function store(Request $request, Progetto $progetto): RedirectResponse
    {
        if (Auth::user()->hasRuolo('ricercatore') && $progetto->ricercatori()->where('ricercatore_id', Auth::user()->id)->exists() ||
            Auth::user()->hasRuolo('finanziatore') || Auth::user()->id == $progetto->responsabile_id) {

            $movimento = new Movimento();
            $this->movimentoFill($request, $movimento, $progetto);
            return redirect()->route('movimento.index', compact('progetto'))->with('success', 'Movimento creato con successo');
        } else {
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non hai i permessi per creare un movimento');
        }
    }

    /**
     * @param Movimento $movimento
     * @param Progetto $progetto
     * @return Factory|View|RedirectResponse|Application
     */
    public function edit(Progetto $progetto, Movimento $movimento): Factory|View|RedirectResponse|Application
    {
        if ($movimento->approvazione != 0){
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non puoi modificare un movimento già approvato');
        } elseif ($progetto->responsabile_id == Auth::user()->id) {
            return view('movimento.edit', compact('movimento', 'progetto'));
        } else {
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non puoi modificare un movimento già approvato');
        }
    }

    /**
     * @param Request $request
     * @param Movimento $movimento
     * @param Progetto $progetto
     * @return RedirectResponse
     */
    public function update(Request $request, Progetto $progetto, Movimento $movimento): RedirectResponse
    {
        if ($movimento->approvazione != 0){
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non puoi modificare un movimento già approvato');
        } elseif ($progetto->responsabile_id == Auth::user()->id) {
            $this->movimentoFill($request, $movimento, $progetto);
            return redirect()->route('movimento.index')->with('success', 'Movimento modificato con successo');
        } else {
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non puoi modificare un movimento già approvato');
        }
    }

    public function approva(Progetto $progetto, Movimento $movimento)
    {
        if ($movimento->approvazione != 0){
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non puoi modificare un movimento già approvato');
        } elseif ($progetto->responsabile_id == Auth::user()->id) {
            $movimento->approvazione = 1;
            $movimento->save();
            $progetto->budget += $movimento->importo;
            $progetto->save();
            return redirect()->route('movimento.index', compact('progetto'));
        } else {
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non hai i permessi per approvare un movimento');
        }
    }

    public function disapprova(Progetto $progetto, Movimento $movimento)
    {
        if ($movimento->approvazione != 0){
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non puoi modificare un movimento già approvato');
        } elseif (Auth::user()->hasRuolo("ricercatore") && $progetto->responsabile_id == Auth::user()->id) {
            $movimento->approvazione = 2;
            $movimento->save();
            return redirect()->route('movimento.index', compact('progetto'));
        } else {
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non hai i permessi per approvare un movimento');
        }
    }

    /**
     * @param Movimento $movimento
     * @param Progetto $progetto
     * @return RedirectResponse
     */
    public function destroy(Progetto $progetto, Movimento $movimento): RedirectResponse
    {
        if ($movimento->approvazione != 0) {
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non puoi eliminare un movimento già approvato');
        } elseif ($progetto->responsabile_id == Auth::user()->id) {
            $movimento->delete();
            return redirect()->route('movimento.index')->with('success', 'Movimento eliminato con successo');
        } else {
            return redirect()->route('movimento.index', compact('progetto'))->with('error', 'Non hai i permessi per eliminare un movimento');
        }
    }

    private function movimentoFill(Request $request, Movimento $movimento, Progetto $progetto)
    {
        $request->validate([
            'causale' => 'required|string',
            'importo' => 'required|numeric|min:0',
        ]);
        if (Auth::user()->hasRuolo("ricercatore")) {
            $movimento->importo = $request->importo * -1;
        } else {
            $movimento->importo = $request->importo;
        }
        $movimento->causale = $request->causale;
        $movimento->data = date('Y-m-d');
        if (Auth::user()->hasRuolo("finanziatore")) {
            $movimento->approvazione = 1;
            $progetto->budget += $movimento->importo;
            $progetto->save();
        } else {
            $movimento->approvazione = 0;
        }
        $movimento->progetto_id = $progetto->id;
        $movimento->utente_id = Auth::user()->id;
        $movimento->save();

        if (Auth::user()->hasRuolo("finanziatore") &&
            !($progetto->finanziatori()->where('finanziatore_id', Auth::user()->id)->exists())) {
            $progetto->finanziatori()->attach(Auth::user()->id);
        }
    }
}

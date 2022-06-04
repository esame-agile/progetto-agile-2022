<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\SottoProgetto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param SottoProgetto $sottoProgetto
     * @return View
     */
    public function create(SottoProgetto $sottoProgetto ): View
    {
        if (SottoProgetto::find($sottoProgetto->id)->responsabile_id == Auth::user()->id) {
            return view('milestone.create', compact('sottoProgetto'));
        } else {
            return view('sotto-progetto.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SottoProgetto $sottoProgetto
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(SottoProgetto $sottoProgetto, Request $request): RedirectResponse
    {
        $milestone = new Milestone();
        $sp = SottoProgetto::where("id",$sottoProgetto->id)->firstOrFail();
        if($sp->responsabile_id != Auth::user()->id){
            return redirect()->route('sotto-progetto.index');
        }
        return $this->milestoneFill($request,$sottoProgetto, $milestone);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SottoProgetto $sottoProgetto
     * @param Milestone $milestone
     * @return View
     */
    public function edit(SottoProgetto $sottoProgetto, Milestone $milestone): View
    {
        if ($milestone->sotto_progetto->responsabile_id == Auth::user()->id && $milestone->sotto_progetto->id == $sottoProgetto->id) {
            return view('milestone.edit', compact('sottoProgetto','milestone'));
        } else {
            return view('sotto-progetto.show', compact('sottoProgetto'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SottoProgetto $sottoProgetto
     * @param Milestone $milestone
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(SottoProgetto $sottoProgetto, Milestone $milestone, Request $request): RedirectResponse
    {
        if ($milestone->sotto_progetto->responsabile_id == Auth::user()->id && $milestone->sotto_progetto->id == $sottoProgetto->id) {
            return $this->milestoneFill($request,$sottoProgetto, $milestone);
        } else {
            return redirect()->route('sotto-progetto.show', compact('sottoProgetto'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Milestone $milestone
     * @return RedirectResponse
     */
    public function destroy(SottoProgetto $sottoProgetto, Milestone $milestone): RedirectResponse
    {
        if ($milestone->sotto_progetto->responsabile_id == Auth::user()->id) {
            $sottoProgetto = $milestone->sotto_progetto;
            $milestone->delete();
            return redirect()->route('sotto-progetto.show', compact('sottoProgetto'))->with('success', 'Milestone eliminato con successo');
        } else {
            return redirect()->route('sotto-progetto.show', compact('sottoProgetto'))->with('error', 'Non puoi eliminare questo Milestone');
        }
    }

    /**
     * @param Request $request
     * @param SottoProgetto $sottoProgetto
     * @param Milestone $milestone
     * @return RedirectResponse
     */
    public function milestoneFill(Request $request, SottoProgetto $sottoProgetto, Milestone $milestone): RedirectResponse
    {
        $request->validate([
            'descrizione' => 'required|max:255|min:3',
            'data_evento' => 'required|date',
        ]);

        $milestone->descrizione = $request->descrizione;
        $milestone->data_evento = $request->data_evento;
        $milestone->sotto_progetto()->associate($sottoProgetto->id);
        $milestone->save();

        return redirect()->route('sotto-progetto.show', compact('sottoProgetto'));
    }
}

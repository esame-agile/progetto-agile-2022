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
     * Display a listing of the resource.
     *
     * @param SottoProgetto $sottoProgetto
     * @return View
     */
    public function index(SottoProgetto $sottoProgetto): View
    {
        $sp = SottoProgetto::where("id",$sottoProgetto->id)->firstOrFail();
        if ($sp->milestones && ($sp->responsabile_id == Auth::user()->id || Auth::user()->hasRuolo("manager"))) {
            $milestones = Milestone::where('sotto_progetto_id', $sottoProgetto->id)->paginate(10);
            return view('milestone.index', compact('sottoProgetto', 'milestones'));
        } else {
            return view('sotto-progetto.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $sottoProgetto
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
     * Display the specified resource.
     *
     * @param SottoProgetto $sottoProgetto
     * @param Milestone $milestone
     * @return View
     */
    public function show(SottoProgetto $sottoProgetto, Milestone $milestone): View
    {
        if (($milestone->sotto_progetto->responsabile_id == Auth::user()->id || Auth::user()->hasRuolo("manager")) && $milestone->sotto_progetto->id == $sottoProgetto->id) {
            return view('milestone.show', compact('sottoProgetto','milestone'));
        } else {
            return view('sotto-progetto.index');
        }
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
            return view('sotto-progetto.index');
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
            return redirect()->route('sotto-progetto.index');
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
            return redirect()->route('milestone.index', compact('sottoProgetto'));
        } else {
            return redirect()->route('sotto-progetto.index');
        }
    }

    /**
     * @param Request $request
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

        return redirect()->route('milestone.index', compact('sottoProgetto'));
    }
}

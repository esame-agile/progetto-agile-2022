<?php

namespace App\Http\Controllers\Milestones;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use App\Models\SottoProgetto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(int $sottoProgetto): View|RedirectResponse
    {
        $sp = SottoProgetto::where("id",$sottoProgetto)->firstOrFail();
        if ($sp->milestones && ($sp->responsabile_id == Auth::user()->id || Auth::user()->hasRuolo("manager"))) {
            $milestones = Milestone::where('sotto_progetto_id', $sottoProgetto)->paginate(10);
            return view('milestones.index', ['sottoProgetto' => $sottoProgetto, 'milestones'=> $milestones]);
        } else {
            return redirect()->route('sottoprogetti.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(int $sottoProgetto ): View
    {
        if (SottoProgetto::find($sottoProgetto)->responsabile_id == Auth::user()->id) {
            return view('milestones.create', ['sottoProgetto' => $sottoProgetto]);
        } else {
            return redirect()->route('sottoprogetti.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(int $sottoProgetto, Request $request): RedirectResponse
    {
        $milestone = new Milestone();
        $sp = SottoProgetto::where("id",$sottoProgetto)->firstOrFail();
        if($sp->responsabile_id != Auth::user()->id){
            return redirect()->route('sottoprogetti.index');
        }
        return $this->milestoneFill($request,$sottoProgetto, $milestone);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return View|RedirectResponse
     */
    public function show($sotto_progetto_id, Milestone $milestone)
    {
        if (($milestone->sotto_progetto->responsabile_id == Auth::user()->id || Auth::user()->hasRuolo("manager")) && $milestone->sotto_progetto->id == $sotto_progetto_id) {
            return view('milestones.show', compact('sotto_progetto_id','milestone'));
        } else {
            return redirect()->route('sottoprogetti.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return View|RedirectResponse
     */
    public function edit(int $sottoProgetto, Milestone $milestone)
    {
        if ($milestone->sotto_progetto->responsabile_id == Auth::user()->id && $milestone->sotto_progetto->id == $sottoProgetto) {
            return view('milestones.edit', compact('sottoProgetto','milestone'));
        } else {
            return redirect()->route('sottoprogetti.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $sottoProgetto, Milestone $milestone, Request $request): RedirectResponse
    {
        if ($milestone->sotto_progetto->responsabile_id == Auth::user()->id && $milestone->sotto_progetto->id == $sottoProgetto) {
            return $this->milestoneFill($request,$sottoProgetto, $milestone);
        } else {
            return redirect()->route('sottoprogetti.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(int $sottoProgetto, Milestone $milestone): RedirectResponse
    {
        if ($milestone->sotto_progetto->responsabile_id == Auth::user()->id && $milestone->sotto_progetto->id == $sottoProgetto) {
            $milestone->delete();
            return redirect()->route('sottoprogetti.milestones.index', ['sottoprogetti' => $sottoProgetto]);
        } else {
            return redirect()->route('sottoprogetti.index');
        }
    }

    /**
     * @param Request $request
     * @param Milestone $milestone
     * @return RedirectResponse
     */
    public function milestoneFill(Request $request, int $sottoProgetto, Milestone $milestone): RedirectResponse
    {
        $request->validate([
            'descrizione' => 'required|max:255|min:3',
            'data_evento' => 'required|date',
        ]);

        $milestone->descrizione = $request->descrizione;
        $milestone->data_evento = $request->data_evento;
        $milestone->sotto_progetto()->associate($sottoProgetto);
        $milestone->save();

        return redirect()->route('sottoprogetti.milestones.index', ['sottoprogetti' => $sottoProgetto]);
    }
}

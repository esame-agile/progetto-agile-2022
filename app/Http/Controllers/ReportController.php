<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Report;
use App\Models\Ricercatore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ReportController extends Controller
{

    public function index()
    {
    }

    public function create(Progetto $progetto) {

        $progetto = Progetto::find($progetto->id);
        if (Auth::user()->hasRuolo('ricercatore')) {
            return view('report.create', compact('progetto'));
        }

    }

    public function store(Request $request, Progetto $progetto)
    {

        //TODO: upload e download file
        $report = new Report;
        $report->titolo = $request->titolo;
        $report->file_name = $request->file;
        $report->data = $request->data_rilascio;
        $report->ricercatore_id = Auth::user()->id;
        $report->progetto_id = $progetto->id;
        $report->save();

        $ricercatori = $progetto->ricercatori()->get();
        $sotto_progetti = $progetto->sotto_progetti()->get();
        $reports = $progetto->reports()->get();

        return view('progetto.show', compact('progetto', 'ricercatori', 'sotto_progetti', 'reports'));

    }

    public function show()
    {

    }

    public function destroy(Report $report, Progetto $progetto)
    {
        if (Auth::user()->hasRuolo('ricercatore')) {
            $report->delete();
        }
        $ricercatori = $progetto->ricercatori()->get();
        $sotto_progetti = $progetto->sotto_progetti()->get();
        $reports = $progetto->reports()->get();

        return redirect()->route('progetto.show', compact('progetto', 'ricercatori', 'sotto_progetti', 'reports'));
    }


}

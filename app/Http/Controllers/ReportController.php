<?php

namespace App\Http\Controllers;

use App\Models\Progetto;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create(Progetto $progetto)
    {
        $progetto = Progetto::find($progetto->id);
        if (Auth::user()->hasRuolo('ricercatore')) {
            return view('report.create', compact('progetto'));
        }
        return redirect()->route('progetto.show', compact('progetto'))->with('error', 'Non sei autorizzato a creare un report');
    }

    public function store(Request $request, Progetto $progetto)
    {

        //TODO: upload e download file
        $report = new Report;
        $report->titolo = $request->titolo;

        //upload del file
        $file = $request->file_name;
        $filename = time() . '.' . $file->extension();
        $request->file_name->move('assets', $filename);
        $report->file_name = $filename;

        $report->data = $request->data_rilascio;
        $report->ricercatore_id = Auth::user()->id;
        $report->progetto_id = $progetto->id;
        $report->save();

        $ricercatori = $progetto->ricercatori()->paginate(10);
        $sottoProgetti = $progetto->sotto_progetti()->paginate(10);
        $reports = $progetto->reports()->paginate(10);
        $pubblicazioni = $progetto->pubblicazioni()->paginate(10);

        return redirect()->route('progetto.show', compact('progetto', 'ricercatori', 'sottoProgetti', 'reports', 'pubblicazioni'));

    }

    public function download(Request $request, $file_name)
    {
        return response()->download(public_path('assets/' . $file_name));
    }

    public function destroy(Report $report)
    {
        $progetto = $report->progetto()->first();
        if (Auth::user()->hasRuolo('ricercatore')) {
            $report->delete();
        }
        return redirect()->route('progetto.show', compact('progetto'));
    }

}

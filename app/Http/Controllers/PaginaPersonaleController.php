<?php

namespace App\Http\Controllers;

use App\Models\Ricercatore;
use App\Models\Utente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaginaPersonaleController extends Controller
{
    public function index()
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        $utente = Auth::user();
        return view('pagina-personale.index', compact('nav', 'utente'));
    }

    public function guest_index(Ricercatore $utente)
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        return view('pagina-personale.index', compact('nav', 'utente'));
    }

    public function edit_info(Utente $utente)
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        return view('pagina-personale.edit-info', compact('nav', 'utente'));
    }

    public function update_info(Utente $utente, Request $request)
    {
        $this->validateUtente();

        $ruolo = $utente->ruolo;

        switch ($ruolo) {
            case 'ricercatore' or 'responsabile':
                $this->validateRicercatoreOrResponsabile();
                if($request->password != null) {
                    $this->validatePassword();
                    $utente->update($request->all(['nome', 'cognome', 'email', 'password', 'data_nascita', 'universita', 'ambito_ricerca']));
                } else {
                    $utente->update($request->all(['nome', 'cognome', 'email', 'data_nascita', 'universita', 'ambito_ricerca']));
                }
                break;
            case 'finanziatore':
                $this->validateFinanziatore();
                if($request->password != null) {
                    $this->validatePassword();
                    $utente->update($request->all(['nome', 'cognome', 'email', 'password', 'nome_azienda']));
                } else {
                    $utente->update($request->all(['nome', 'cognome', 'email', 'nome_azienda']));
                }
                break;
            case 'manager':
                if($request->password != null) {
                    $this->validatePassword();
                    $utente->update($request->all(['nome', 'cognome', 'email', 'password']));
                } else {
                    $utente->update($request->all(['nome', 'cognome', 'email']));
                }
                break;
            default:
                return redirect()->route('pagina-personale.edit-info', compact('utente'))->with('error', 'Qualcosa è andato storto.');
        }

        /*if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('storage'), $name);

                $image = new ImageRoom();
                $image->path = $name;
                $image->room_id = $room->id;
                $image->save();
            }
        }*/

        return redirect()->route('pagina-personale.index', compact('utente'))->with('success', 'Informazioni aggiorante con successo.');
    }

    protected function validateUtente()
    {
        return request()->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
        ]);
    }

    protected function validateRicercatoreOrResponsabile()
    {
        return request()->validate([
            'data_nascita' => 'required',
            'universita' => 'required',
            'ambito_ricerca' => 'required',
        ]);
    }

    protected function validateFinanziatore()
    {
        return request()->validate([
            'nome_azienda' => 'required',
        ]);
    }

    protected function validatePassword()
    {
        return request()->validate([
            'password' => 'required|same:password_confirmation',
        ]);
    }
}

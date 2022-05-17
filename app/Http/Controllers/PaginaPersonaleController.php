<?php

namespace App\Http\Controllers;

use App\Models\Finanziatore;
use App\Models\Manager;
use App\Models\Responsabile;
use App\Models\Ricercatore;
use App\Models\Utente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaginaPersonaleController extends Controller
{
    public function index()
    {
        $utente = Auth::user();
        $pubblicazioni = ['pub1', 'pub2', 'pub3'];   /*da definire*/
        $progetti = ['prog1', 'prog2', 'prog3'];     /*da definire*/
        return view('pagina-personale.ricercatore.index', compact('utente', 'pubblicazioni', 'progetti'));
    }

    public function guest_index(Ricercatore $utente)
    {
        return view('pagina-personale.ricercatore.guest-index', compact ('utente'));
    }

    public function edit_info(Utente $utente)
    {
        return view('pagina-personale.ricercatore.edit-info', compact('utente'));
    }

    public function update_info(Utente $utente, Request $request)
    {
        $this->validateUtente();

        switch ($utente->ruolo) {
            case 'ricercatore':
                $utente = Ricercatore::find($utente->id);
                $this->validateRicercatoreOrResponsabile();
                if($request->password != null) {
                    $this->validatePassword();
                    $utente->update($request->all(['nome', 'cognome', 'email', 'password', 'data_nascita', 'universita', 'ambito_ricerca']));
                } else {
                    $utente->update($request->all(['nome', 'cognome', 'email', 'data_nascita', 'universita', 'ambito_ricerca']));
                }
                break;
            case 'responsabile':
                $utente = Responsabile::find($utente->id);
                $this->validateRicercatoreOrResponsabile();
                if($request->password != null) {
                    $this->validatePassword();
                    $utente->update($request->all(['nome', 'cognome', 'email', 'password', 'data_nascita', 'universita', 'ambito_ricerca']));
                } else {
                    $utente->update($request->all(['nome', 'cognome', 'email', 'data_nascita', 'universita', 'ambito_ricerca']));
                }
                break;
            case 'finanziatore':
                $utente = Finanziatore::find($utente->id);
                $this->validateFinanziatore();
                if($request->password != null) {
                    $this->validatePassword();
                    $utente->update($request->all(['nome', 'cognome', 'email', 'password', 'nome_azienda']));
                } else {
                    $utente->update($request->all(['nome', 'cognome', 'email', 'nome_azienda']));
                }
                break;
            case 'manager':
                $utente = Manager::find($utente->id);
                if($request->password != null) {
                    $this->validatePassword();
                    $utente->update($request->all(['nome', 'cognome', 'email', 'password']));
                } else {
                    $utente->update($request->all(['nome', 'cognome', 'email']));
                }
                break;
            default:
                return redirect()->route('pagina-personale.ricercatore.edit-info', compact('utente'))->with('error', 'Qualcosa è andato storto.');
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

        return redirect()->route('pagina-personale.ricercatore.index', compact('utente'))->with('success', 'Informazioni aggiorante con successo.');
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

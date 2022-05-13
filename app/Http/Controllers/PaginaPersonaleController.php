<?php

namespace App\Http\Controllers;

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

        $user = Auth::user();
        return view('pagina-personale.index', compact('nav', 'user'));
    }

    public function guest_index(Utente $user)
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];
        return view('pagina-personale.guestIndex', compact('nav', 'user'));
    }

    public function edit_info(Utente $user)
    {
        $nav = [
            ['label' => 'HOME', 'class' => 'nav-link', 'href' => 'http://127.0.0.1:8000/'],
        ];

        return view('pagina-personale.edit-info', compact('nav', 'user'));
    }

    public function update_info(Utente $user, Request $request)
    {
        $this->validateUser();

        $user->update($request->all(['nome', 'cognome', 'email', 'data_nascita', 'universita', 'ambito_ricerca', 'nome_azienda']));

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

        return redirect()->route('pagina-personale.index', compact('user'))->with('success', 'Informazioni aggiorante con successo.');
    }

    protected function validateUser()
    {
        return request()->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
            'data_nascita' => 'required',
            'universita' => 'required',
            'ambito_ricerca' => 'required',
            'nome_azienda' => 'required',
        ]);
    }
}

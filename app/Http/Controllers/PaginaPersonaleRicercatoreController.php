<?php

namespace App\Http\Controllers;

use App\Models\Ricercatore;
use App\Models\Utente;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaginaPersonaleRicercatoreController extends Controller
{
    /**
     * Vista pagina personale ricercatore.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $utente = Auth::user();
        $ricercatore = Ricercatore::find($utente->id);
        $progetti = $ricercatore->progetti()->get();

        return view('pagina-personale.ricercatore.index', compact('utente', 'progetti'));
    }

    /**
     * Vista pagina personale ricercatore per non autenticati.
     *
     * @param Ricercatore $utente
     * @return Factory|View|Application
     */
    public function guest_index(Ricercatore $utente): Factory|View|Application
    {
        $progetti = $utente->progetti()->get();

        return view('pagina-personale.ricercatore.guest-index', compact('utente', 'progetti'));
    }

    /**
     * Vista per editare i dati personali di un ricercatore.
     *
     * @param Utente $utente
     * @return Factory|View|Application
     */
    public function edit_info(Utente $utente): Factory|View|Application
    {
        return view('pagina-personale.ricercatore.edit-info', compact('utente'));
    }

    /**
     * Aggiornamento dati personali ricercatore.
     *
     * @param Utente $utente
     * @param Request $request
     * @return RedirectResponse
     */
    public function update_info(Utente $utente, Request $request): RedirectResponse
    {
        $utente = Ricercatore::find($utente->id);
        $this->validateRicercatore();
        if ($request->password != null) {
            $this->validatePassword();
            $utente->update($request->all(['nome', 'cognome', 'email', 'password', 'data_nascita', 'universita', 'ambito_ricerca']));
        } else {
            $utente->update($request->all(['nome', 'cognome', 'email', 'data_nascita', 'universita', 'ambito_ricerca']));
        }
        return redirect()->route('pagina-personale.ricercatore.index', compact('utente'))->with('success', 'Informazioni aggiorante con successo.');
    }

    /**
     * Validazione dei dati di un ricercatore
     *
     * @return array
     */
    protected function validateRicercatore(): array
    {
        return request()->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
            'data_nascita' => 'required',
            'universita' => 'required',
            'ambito_ricerca' => 'required',
        ]);
    }

    /**
     * Validazione della password
     *
     * @return array
     */
    protected function validatePassword(): array
    {
        return request()->validate([
            'password' => 'required|same:password_confirmation',
        ]);
    }
}

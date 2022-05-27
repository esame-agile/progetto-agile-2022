<?php

namespace App\Http\Controllers;

use App\Models\Finanziatore;
use App\Models\Utente;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaginaPersonaleFinanziatoreController extends Controller
{
    /**
     * Vista pagina personale finanziatore.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $utente = Auth::user();
        $finanziatore = Finanziatore::find($utente->id);
        $progetti = $finanziatore->progetti()->get();

        return view('pagina-personale.finanziatore.index', compact('utente', 'progetti'));
    }

    /**
     * Vista per editare i dati personali di un finanziatore.
     *
     * @param Utente $utente
     * @return Factory|View|Application
     */
    public function edit_info(Utente $utente): Factory|View|Application
    {
        return view('pagina-personale.finanziatore.edit-info', compact('utente'));
    }

    /**
     * Aggiornamento dati personali finanziatore.
     *
     * @param Utente $utente
     * @param Request $request
     * @return RedirectResponse
     */
    public function update_info(Utente $utente, Request $request): RedirectResponse
    {
        $utente = Finanziatore::find($utente->id);
        $this->validateFinanziatore();
        if ($request->password != null) {
            $this->validatePassword();
            $utente->update($request->all(['nome', 'cognome', 'email', 'password', 'nome_azienda']));
        } else {
            $utente->update($request->all(['nome', 'cognome', 'email', 'nome_azienda']));
        }
        return redirect()->route('pagina-personale.finanziatore.index', compact('utente'))->with('success', 'Informazioni aggiorante con successo.');
    }

    /**
     * Validazione dei dati di un finanziatore
     *
     * @return array
     */
    protected function validateFinanziatore(): array
    {
        return request()->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
            'nome_azienda' => 'required',
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

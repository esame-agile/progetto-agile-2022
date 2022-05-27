<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Utente;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaginaPersonaleManagerController extends Controller
{
    /**
     * Vista pagina personale manager.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $utente = Auth::user();
        $manager = Manager::find($utente->id);
        //$progetti = $manager->progetti()->get();

        return view('pagina-personale.manager.index', compact('utente'));
    }

    /**
     * Vista per editare i dati personali di un manager.
     *
     * @param Utente $utente
     * @return Factory|View|Application
     */
    public function edit_info(Utente $utente): Factory|View|Application
    {
        return view('pagina-personale.manager.edit-info', compact('utente'));
    }

    /**
     * Aggiornamento dati personali manager.
     *
     * @param Utente $utente
     * @param Request $request
     * @return RedirectResponse
     */
    public function update_info(Utente $utente, Request $request): RedirectResponse
    {
        $utente = Manager::find($utente->id);
        $this->validateManager();
        if ($request->password != null) {
            $this->validatePassword();
            $utente->update($request->all(['nome', 'cognome', 'email', 'password']));
        } else {
            $utente->update($request->all(['nome', 'cognome', 'email']));
        }
        return redirect()->route('pagina-personale.manager.index', compact('utente'))->with('success', 'Informazioni aggiorante con successo.');
    }

    /**
     * Validazione dei dati di un manager
     *
     * @return array
     */
    protected function validateManager(): array
    {
        return request()->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required',
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

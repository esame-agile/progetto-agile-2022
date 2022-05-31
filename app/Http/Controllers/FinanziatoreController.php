<?php

namespace App\Http\Controllers;

use App\Models\Finanziatore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FinanziatoreController extends Controller
{
    /**
     * Vista pagina personale finanziatore.
     *
     * @return Factory|View|Application
     */
    public function show(): Factory|View|Application
    {
        $finanziatore = Finanziatore::find(Auth::user()->id);
        $progetti = $finanziatore->progetti()->paginate(10);

        return view('finanziatore.show', compact('finanziatore', 'progetti'));
    }

    /**
     * Vista per editare i dati personali di un finanziatore.
     *
     * @param Finanziatore $finanziatore
     * @return Factory|View|Application
     */
    public function edit(Finanziatore $finanziatore): Factory|View|Application
    {
        return view('finanziatore.edit', compact('finanziatore'));
    }

    /**
     * Aggiornamento dati personali finanziatore.
     *
     * @param Finanziatore $finanziatore
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Finanziatore $finanziatore, Request $request): RedirectResponse
    {
        $this->validateFinanziatore();
        if ($request->password != null) {
            $this->validatePassword();
            $finanziatore->update($request->all(['nome', 'cognome', 'email', 'password', 'nome_azienda']));
        } else {
            $finanziatore->update($request->all(['nome', 'cognome', 'email', 'nome_azienda']));
        }
        return redirect()->route('finanziatore.show', compact('finanziatore'))->with('success', 'Informazioni aggiorante con successo.');
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

<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Vista pagina personale manager.
     *
     * @return Factory|View|Application
     */
    public function show(): Factory|View|Application
    {
        $manager = Manager::find(Auth::user()->id);
        return view('manager.show', compact('manager'));
    }

    /**
     * Vista per editare i dati personali di un manager.
     *
     * @param Manager $manager
     * @return Factory|View|Application|RedirectResponse
     */
    public function edit(Manager $manager): Factory|View|Application|RedirectResponse
    {
        if (Auth::user()->id == $manager->id){
            return view('manager.edit', compact('manager'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Aggiornamento dati personali manager.
     *
     * @param Manager $manager
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Manager $manager, Request $request): RedirectResponse
    {
        $this->validateManager();
        if ($request->password != null) {
            $this->validatePassword();
            $manager->update($request->all(['nome', 'cognome', 'email', 'password']));
        } else {
            $manager->update($request->all(['nome', 'cognome', 'email']));
        }
        return redirect()->route('manager.show', compact('manager'))->with('success', 'Informazioni aggiornate con successo.');
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

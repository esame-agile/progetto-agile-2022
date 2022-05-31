<?php

namespace App\Http\Controllers;

use App\Models\Ricercatore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RicercatoreController extends Controller
{
    /**
     * Vista con elenco dei ricercatori
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $ricercatori = Ricercatore::paginate(10);
        return view('ricercatore.index', compact('ricercatori'));
    }


    /**
     * Vista pagina personale ricercatore.
     *
     * @return Factory|View|Application
     */
    public function show(): Factory|View|Application
    {
        $ricercatore = Ricercatore::find(Auth::user()->id);
        $progetti = $ricercatore->progetti()->paginate(10);
        $pubblicazioni=$ricercatore->pubblicazioni()->paginate(10);

        return view('ricercatore.show', compact('ricercatore', 'progetti','pubblicazioni'));
    }

    /**
     * Vista pagina personale ricercatore per non autenticati.
     *
     * @param Ricercatore $ricercatore
     * @return Factory|View|Application
     */
    public function guest_show(Ricercatore $ricercatore): Factory|View|Application
    {
        $progetti = $ricercatore->progetti()->paginate(10);
        $pubblicazioni=$ricercatore->pubblicazioni()->where('ufficiale','=','1')->paginate(10);

        return view('ricercatore.guest-show', compact('ricercatore', 'progetti','pubblicazioni'));

    }

    /**
     * Vista per editare i dati personali di un ricercatore.
     *
     * @param Ricercatore $ricercatore
     * @return Factory|View|Application
     */
    public function edit(Ricercatore $ricercatore): Factory|View|Application
    {
        return view('ricercatore.edit', compact('ricercatore'));
    }

    /**
     * Aggiornamento dati personali ricercatore.
     *
     * @param Ricercatore $ricercatore
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Ricercatore $ricercatore, Request $request): RedirectResponse
    {
        $this->validateRicercatore();
        if ($request->password != null) {
            $this->validatePassword();
            $ricercatore->update($request->all(['nome', 'cognome', 'email', 'password', 'data_nascita', 'universita', 'ambito_ricerca']));
        } else {
            $ricercatore->update($request->all(['nome', 'cognome', 'email', 'data_nascita', 'universita', 'ambito_ricerca']));
        }
        return redirect()->route('ricercatore.show', compact('ricercatore'))->with('success', 'Informazioni aggiorante con successo.');
    }

    /**
     * Vista con l'elenco dei progetto del ricercaotore
     *
     * @return Factory|View|Application
     */
    public function progetti(): Factory|View|Application
    {
        $mieiProgetti = true;
        $progetti = Ricercatore::find(Auth::user()->id)->progetti()->paginate(10);
        return view('progetto.index', compact('progetti', 'mieiProgetti'));
    }

    /**
     * Vista con l'elenco dei progetto del ricercaotore
     *
     * @return Factory|View|Application
     */
    public function sotto_progetti(): Factory|View|Application
    {
        $mieiSottoProgetti = true;
        $sottoProgetti = Ricercatore::find(Auth::user()->id)->sotto_progetti()->paginate(10);
        return view('sotto-progetto.index', compact('sottoProgetti', 'mieiSottoProgetti'));
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

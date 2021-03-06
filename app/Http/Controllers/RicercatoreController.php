<?php

namespace App\Http\Controllers;

use App\Models\Pubblicazione;
use App\Models\Ricercatore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
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

        $pubblicazioni = $ricercatore->pubblicazioni()->get();
        $pubblicazioni = $this->getPubblicazioni($ricercatore, $pubblicazioni);
        $pubblicazioni = $this->paginate($pubblicazioni);
        return view('ricercatore.show', compact('ricercatore', 'progetti', 'pubblicazioni'));
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
        $pubblicazioni=$ricercatore->pubblicazioni()->where('ufficiale','=','true')->get();
        $pubblicazioni = $this->getPubblicazioni($ricercatore, $pubblicazioni);
        $pubblicazioni = $this->paginate($pubblicazioni);
        return view('ricercatore.guest-show', compact('ricercatore', 'progetti', 'pubblicazioni'));
    }

    /**
     * Vista per editare i dati personali di un ricercatore.
     *
     * @param Ricercatore $ricercatore
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Ricercatore $ricercatore): Application|Factory|View|RedirectResponse
    {
        if (Auth::user()->id == $ricercatore->id){
            return view('ricercatore.edit', compact('ricercatore'));
        } else {
            return redirect()->route('home');
        }
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
            $ricercatore->update($request->all(['nome', 'cognome', 'email', 'password', 'data_nascita', 'universita', 'ambito_ricerca', 'pid']));
        } else {
            $ricercatore->update($request->all(['nome', 'cognome', 'email', 'data_nascita', 'universita', 'ambito_ricerca', 'pid']));
        }
        return redirect()->route('ricercatore.show', compact('ricercatore'))->with('success', 'Informazioni aggiornate con successo.');
    }

    /**
     * Vista con l'elenco dei progetti del ricercatore
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
     * Vista con l'elenco dei progetti del ricercatore
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
            'pid' => 'required|string|max:4|min:4',
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

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => request()->url(), 'query' => request()->query()]);
    }

    /**
     * @param Ricercatore $ricercatore
     * @param \Illuminate\Database\Eloquent\Collection|array $pubblicazioni
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getPubblicazioni(Ricercatore $ricercatore, \Illuminate\Database\Eloquent\Collection|array $pubblicazioni): array|\Illuminate\Database\Eloquent\Collection
    {
        $author = str_replace(" ", "_", $ricercatore->nome) . "_" . str_replace(" ", "_", $ricercatore->cognome);
        if($ricercatore->pid != '0000') {
            $author = $author . "_" . $ricercatore->pid;
        }
        $url = "https://dblp.org/search/publ/api?q=author:" . $author . ":&format=json&h=1000";

        $pubbl = json_decode(file_get_contents($url), true);
        if (isset($pubbl['result']['hits']['hit'])) {
            foreach ($pubbl['result']['hits']['hit'] as $pubb) {
                $pubbli = new Pubblicazione();
                $pubbli->titolo = $pubb['info']['title'];
                $pubbli->doi = $pubb['info']['doi'] ?? "";
                $pubbli->sorgente = "api";
                $pubbli->progetto = "-";
                $pubbli->tipologia = $pubb['info']['type'];
                $pubbli->file_name = "-";
                $pubblicazioni[] = $pubbli;
            }
        }
        return $pubblicazioni;
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Utente;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $utente = Auth::user();
        //$utente = Utente::where('email', $request->email)->first();

        //In base al ruolo, fa l'accesso
        if($utente->ruolo=='manager') {
            return redirect()->intended(RouteServiceProvider::MANAGER);
        }
        if($utente->ruolo=='ente finanziatore') {
            return redirect()->intended(RouteServiceProvider::ENTEFINANZIATORE);
        }
        if($utente->ruolo=='ricercatore') {
            return redirect()->intended(RouteServiceProvider::RICERCATORE);
        }


        else return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

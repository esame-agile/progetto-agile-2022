<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

           if (Auth::guard($guard)->check() && auth()->user()->ruolo == 'manager') {
               return redirect(RouteServiceProvider::MANAGER);
           }

        }

        /*

    if (Auth::guard($guard)->check() && auth()->user()->type == 'admin'){
        return redirect('/admin');
    }

    if (Auth::guard($guard)->check() && auth()->user()->type == 'author'){
        return redirect('/author');
    }

    if (Auth::guard($guard)->check() && auth()->user()->type == 'client'){
        return redirect('/client');
    }
         */



        return $next($request);
    }
}

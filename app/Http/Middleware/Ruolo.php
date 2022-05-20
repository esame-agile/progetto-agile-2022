<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Ruolo
{
    public function handle($request, Closure $next, ... $roles)
    {
        if (!Auth::check())
            return redirect('login');

        $user = Auth::user();

        foreach($roles as $role) {
            if($user->hasRuolo($role)) {
                return $next($request);
            }
        }

        return redirect('login');
    }
}

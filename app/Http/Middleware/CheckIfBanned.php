<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->baneado) {
            // Si ya está en la vista de baneo, dejar pasar
            if ($request->routeIs('baneado')) {
                return $next($request);
            }

            // Si intenta acceder a cualquier otro sitio, lo mandamos a la vista baneado
            return redirect()->route('baneado');
        }

        return $next($request);
    }
}

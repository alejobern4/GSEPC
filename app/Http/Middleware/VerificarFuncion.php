<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarFuncion
{
    public function handle(Request $request, Closure $next, $funcion)
    {
        if (!Auth::check() || !Auth::user()->tieneFuncion($funcion)) {
            abort(403, 'No tienes permiso para acceder.');
        }

        return $next($request);
    }
}

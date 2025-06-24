<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdministrador
{

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->Puesto !== 'Administrador') {
            return response()->json(
                ['error' => 'Acceso denegado. Se requiere el puesto de Administrador para hacer esta operacion'],
                403
            );
        }
        return $next($request);
    }
}

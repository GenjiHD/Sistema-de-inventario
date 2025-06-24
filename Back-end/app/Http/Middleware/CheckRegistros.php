<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistros
{

    public function handle(Request $request, Closure $next): Response
    {
        $puesto = $request->user()->Puesto;

        // Permitir registros solo para los roles Registros y Administrador
            if(!in_array($puesto, ['Registros', 'Administrador'])) {
            return response()->json(
                ['error' => 'Acceso denegado. Se requiere el puesto de Registros para hacer esta operacion'],
                403
            );
        }

        if($puesto === 'Registros' && str_contains($request->path(), 'usuarios')) {
            return response()->json(
                ['error' => 'Solo el Administrador puede gestionar los usuarios'],
                403
            );
        }
        return $next($request);
    }
}

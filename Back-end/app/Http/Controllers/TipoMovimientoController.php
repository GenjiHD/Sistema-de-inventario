<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoMovimiento;
use Illuminate\Http\Request;

class TipoMovimientoController extends Controller
{
    public function index()
    {
        $tipoMovimiento = TipoMovimiento::all();

        if ($tipoMovimiento->isEmpty()) {
            $data = [
                'message' => "No hay movimientos",
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($tipoMovimiento, 200);
    }
}

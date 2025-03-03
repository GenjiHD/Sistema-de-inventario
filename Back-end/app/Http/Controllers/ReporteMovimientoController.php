<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReporteMovimiento;
use Illuminate\Http\Request;

class ReporteMovimientoController extends Controller
{
    public function index()
    {
        $reporteMovimientos = ReporteMovimiento::all();

        if ($reporteMovimientos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron reportes de movimientos',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($reporteMovimientos, 200);
    }
}

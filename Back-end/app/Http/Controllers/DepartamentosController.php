<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    public function index()
    {
        $departamentos = Departamentos::all();

        if ($departamentos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron departamentos',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($departamentos, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Municipios;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{
    public function index()
    {
        $municipios = Municipios::all();
        if ($municipios->isEmpty()) {
            $data = [
                'message' => 'No se encontraron municipios',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($municipios, 200);
    }
}

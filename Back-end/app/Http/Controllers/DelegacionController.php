<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delegacion;

class DelegacionController extends Controller
{
    public function index()
    {
        $delegaciones = Delegacion::all();

        if ($delegaciones->isEmpty()) {
            $data = [
                'message' => 'No se encontraron las delegaciones',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($delegaciones, 200);
    }
}

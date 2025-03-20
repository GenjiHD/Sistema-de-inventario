<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoMovimiento;
use Illuminate\Support\Facades\Validator;
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

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Descripcion' => 'required'
        ]);

        try {
            $tipomov = TipoMovimiento::create($validateData);

            $data = [
                'Tipo movimiento' => $tipomov,
                'message' => 'El tipo de movimiento fue creado correctamente',
                'status' => 200
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'message' => 'El tipo de movmiento no pudo ser creado:' . $e->getMessage(),
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $tipomov = TipoMovimiento::find($id);

        if (!$tipomov) {
            return response()->json([
                'message' => 'El tipo de movmiento no fue encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'Descripcion' => 'sometimes',
        ]);

        if (!$validator->fails()) {
            return response()->json([
                'message' => 'Error de validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $tipomov->fill($validator->validated());
        $tipomov->save();

        return response()->json([
            'message' => 'El movimiento ha sido actualizado correctamente',
            'Tipo Movimiento' => $tipomov,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $tipomov = TipoMovimiento::find($id);

        if (!$tipomov) {
            $data = [
                'message' => 'El tipo de movimiento no fue encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $tipomov->delete();

        $data = [
            'message' => 'El tipo de movimiento fue eliminado correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Descripcion' => 'required'
        ]);

        try {
            $departamento = Departamentos::create($validateData);
            $data = [
                'Departamentos' => $departamento,
                'message' => 'El departamento se creo correctamente',
                'error' => 200
            ];
        } catch (\Exception $e) {
            $data = [
                'message' => 'Error al crear el departamento: ',
                $e->getMessage(),
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamentos::find($id);

        if (!$departamento) {
            return response()->json([
                'message' => 'Departamento no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'Descripcion' => 'sometimes'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Actualizar solo los campos proporcionados en la solicitud
        $departamento->fill($validator->validated());

        // Guardar los cambios en la base de datos
        $departamento->save();

        // Retornar una respuesta exitosa
        return response()->json([
            'message' => 'Departamento actualizado correctamente',
            'Producto' => $departamento,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $departamento = Departamentos::find($id);

        if (!$departamento) {
            $data = [
                'message' => 'Departamento no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $departamento->delete();

        $data = [
            'message' => 'Departamento eliminado correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function buscar(Request $request)
    {

        $termino = $request->query('q');


        if (empty($termino)) {
            return response()->json([
                'message' => 'Debe proporcionar un término de búsqueda',
                'status' => 400
            ], 400);
        }


        $departamento = Departamentos::where('DeptoID', 'like', "%$termino%")
            ->orWhere('Descripcion', 'like', "%$termino%")
            ->get();


        if ($departamento->isEmpty()) {
            return response()->json([
                'message' => 'No se encontro el departamento',
                'status' => 404
            ], 404);
        }


        return response()->json([
            'message' => 'Departamento encontrado',
            'productos' => $departamento,
            'status' => 200
        ], 200);
    }
}

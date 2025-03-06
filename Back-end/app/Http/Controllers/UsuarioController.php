<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuario::all();

        if ($usuario->isEmpty()) {
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($usuario, 200);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'Nombre' => 'required',
            'Contraseña' => 'required',
            'Puesto' => 'required',
            'Estado' => 'required|boolean'
        ]);

        // Encriptar la contraseña
        $validatedData['Contraseña'] = bcrypt($validatedData['Contraseña']);

        // Crear el usuario
        try {
            $usuario = Usuario::create($validatedData);

            // Respuesta exitosa
            $data = [
                'usuario' => $usuario,
                'message' => 'Usuario creado exitosamente',
                'status' => 201
            ];

            return response()->json($data, 201);
        } catch (\Exception $e) {
            // Manejo de errores
            $data = [
                'message' => "Error al crear el usuario: " . $e->getMessage(),
                'status' => 500
            ];

            return response()->json($data, 500);
        }
    }
}

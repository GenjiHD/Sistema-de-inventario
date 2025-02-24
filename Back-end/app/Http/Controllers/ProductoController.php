<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Producto::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validated([
            'NumeroControl' => 'required | string | max:30',
            'NumeroSerie' => 'required | string | max:30',
            'Descripcion' => 'required | string | max:300',
            'Modelo' => 'required | string | max:50',
            'Marca' => 'required | string | max:50',
            'Categoria' => 'required | string | max:30',
            'Factura' => 'nullable | string | max:30',
            'Cantidad' => 'required | integer | min:0',
            'Valor' => 'required | numeric | min:0'
        ]);

        $producto = Producto::create($validated);
        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['Error' => 'Producto no encontrado'], 404);
        }
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['Error' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'NumeroControl' => 'nullable | string | max:30',
            'NumeroSerie' => 'nullable | string | max:30',
            'Descripcion' => 'required | string | max:300',
            'Modelo' => 'nullable | string | max:50',
            'Marca' => 'nullable | string | max:50',
            'Categoria' => 'nullable | string | max:30',
            'Factura' => 'nullable | string | max:30',
            'Cantidad' => 'integer | min:0',
            'Valor' => 'numeric | min:0',
        ]);

        $producto->update($validated);
        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['Error' => 'Producto no encontrado'], 404);
        }
        $producto->delete();
        return response()->json(['message' => 'Artículo eliminado']);
    }
}

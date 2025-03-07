<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Productos::all();

        if ($productos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron productos',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($productos, 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'NumeroControl' => 'required',
            'NumeroSerie' => 'required',
            'Descripcion' => 'required',
            'Modelo' => 'required',
            'Marca' => 'required',
            'Categoria' => 'required',
            'Factura' => 'required',
            'Cantidad' => 'required|int',
            'Valor' => 'required'
        ]);

        try {
            $producto = Productos::create($validateData);

            $data = [
                'Productos' => $producto,
                'message' => 'El producto se creo correctamente',
                'status' => 200
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {

            $data = [
                'message' => 'Error al crear el producto: ' . $e->getMessage(),
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $producto = Productos::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = $request->validate([
            'NumeroControl' => 'sometimes|string',
            'NumeroSerie' => 'sometimes|string',
            'Descripcion' => 'sometimes|string',
            'Modelo' => 'sometimes|string',
            'Marca' => 'sometimes|string',
            'Categoria' => 'sometimes|string',
            'Factura' => 'sometimes|string',
            'Cantidad' => 'sometimes|int',
            'Valor' => 'sometimes|double'
        ]);

        if (isset($producto['NumeroControl'])) {
            $producto->NumeroControl = $validator['NumeroControl'];
        }
        if (isset($producto['NumeroSerie'])) {
            $producto->NumeroSerie = $validator['NumeroSerie'];
        }
        if (isset($producto['Descripcion'])) {
            $producto->Descripcion = $validator['Descripcion'];
        }
        if (isset($producto['Modelo'])) {
            $producto->Modelo = $validator['Modelo'];
        }
        if (isset($producto['Marca'])) {
            $producto->Marca = $validator['Marca'];
        }
        if (isset($producto['Categoria'])) {
            $producto->Categorias = $validator['Categoria'];
        }
        if (isset($producto['Factura'])) {
            $producto->Factura = $validator['Factura'];
        }
        if (isset($producto['Cantidad'])) {
            $producto->Cantidad = $validator['Cantidad'];
        }
        if (isset($producto['Valor'])) {
            $producto->Valor = $validator['Valor'];
        }

        $producto->save();

        $data = [
            'message' => 'Producto guardado correctamente',
            'Producto' => $producto,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $producto = Productos::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $producto->delete();

        $data = [
            'message' => 'Producto eliminado correctamente',
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


        $productos = Productos::where('NumeroControl', 'like', "%$termino%")
            ->orWhere('NumeroSerie', 'like', "%$termino%")
            ->get();


        if ($productos->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron productos',
                'status' => 404
            ], 404);
        }


        return response()->json([
            'message' => 'Productos encontrados',
            'productos' => $productos,
            'status' => 200
        ], 200);
    }
}

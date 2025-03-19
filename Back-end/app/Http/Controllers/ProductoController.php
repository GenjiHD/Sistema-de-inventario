<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // Buscar el producto por ID
        $producto = Productos::find($id);

        // Si el producto no existe, retornar un error 404
        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado',
                'status' => 404
            ], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'NumeroControl' => 'sometimes|string|max:30',
            'NumeroSerie' => 'sometimes|string|max:30',
            'Descripcion' => 'sometimes|string|max:300',
            'Modelo' => 'sometimes|string|max:50',
            'Marca' => 'sometimes|string|max:50',
            'Categoria' => 'sometimes|string|max:30',
            'Factura' => 'sometimes|string|max:30',
            'Cantidad' => 'sometimes|integer',
            'FechaAlta' => 'sometimes|date',
            'FechaBaja' => 'sometimes|date|nullable',
            'Valor' => 'sometimes|numeric|between:0,99999999.99'
        ]);

        // Si la validación falla, retornar errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Actualizar solo los campos proporcionados en la solicitud
        $producto->fill($validator->validated());

        // Guardar los cambios en la base de datos
        $producto->save();

        // Retornar una respuesta exitosa
        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'Producto' => $producto,
            'status' => 200
        ], 200);
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

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReporteMovimiento;
use Dotenv\Repository\RepositoryInterface;
use Dotenv\Util\Regex;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'ProductoID' => 'required',
            'UsuarioID' => 'required',
            'DeleOrigen' => 'required',
            'DeleDestino' => 'required',
            'DeptoOrigen' => 'required',
            'DeptoDestino' => 'required',
            'TipoMovID' => 'required',
            'FechaMov' => 'required'
        ]);

        try {
            $Reporte = ReporteMovimiento::create($validateData);
            $data = [
                'Reporte' => $Reporte,
                'message' => 'Reporte creado correctamente',
                'status' => 200
            ];
        } catch (\Exception $e) {
            $data = [
                'message' => 'Error al crear el reporte: ' . $e->getMessage(),
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $reporte = ReporteMovimiento::find($id);

        if (!$reporte) {
            return response()->json([
                'message' => 'Reporte no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'ProductoID' => 'sometimes',
            'UsuarioID' => 'sometimes',
            'DeleOrigen' => 'sometimes',
            'DeleDestino' => 'sometimes',
            'DeptoOrigen' => 'sometimes',
            'DeptoDestino' => 'sometimes',
            'TipoMovID' => 'sometimes',
            'FechaMov' => 'sometimes'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $reporte->fill($validator->validated());
        $reporte->save();

        return response()->json([
            'message' => 'Reporte actualizado correctamente',
            'reporte' => $reporte,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $reporte = ReporteMovimiento::find($id);

        if (!$reporte) {
            $data = [
                'message' => 'No se encontro el repote de movimiento',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $reporte->delete();

        $data = [
            'message' => 'Reporte de movimiento eliminado correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function buscas(Request $request)
    {
        $termino = $request->query('q');

        if (empty(!$termino)) {
            return response()->json([
                'message' => 'Debe proporcionar un termino de busqueda',
                'status' => 400
            ], 400);
        }

        $reporte = ReporteMovimiento::where('FechaMov', 'like', "%termino%")->get();

        if ($reporte->isEmpty()) {
            return response()->json([
                'message' => 'No se encontro ese reporte',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Reporte encontrado',
            'reporte' => $reporte,
            'status' => 200
        ], 200);
    }
}

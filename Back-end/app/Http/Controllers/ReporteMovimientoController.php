<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReporteMovimiento;
use App\Models\TipoMovimiento;
use Dotenv\Repository\RepositoryInterface;
use Dotenv\Util\Regex;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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
        $validator = Validator::make($request->all(), [
            'ProductoID' => 'required|exists:Productos,ProductoID',
            'UsuarioID' => 'required|exists:Usuario,UsuarioID',
            'TipoMovimiento' => 'required|string',
            'FechaMov' => 'required|date',
            'DeleOrigen' => 'nullable|exists:Delegaciones,DelegacionID',
            'DeleDestino' => 'nullable|exists:Delegaciones,DelegacionID',
            'DeptoOrigen' => 'nullable|exists:Departamentos,DeptoID',
            'DeptoDestino' => 'nullable|exists:Departamentos,DeptoID',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tipoMovimiento = TipoMovimiento::where('Descripcion', $request->TipoMovimiento)->first();

        if (!$tipoMovimiento) {
            return response()->json(['message' => 'Tipo Movimiento no valido'], 400);
        }

        DB::beginTransaction();
        try {
            $movimiento = ReporteMovimiento::create([
                'ProductoID' => $request->ProductoID,
                'UsuarioID' => $request->UsuarioID,
                'TipoMovID' => $tipoMovimiento->TipoMovID,
                'FechaMov' => $request->FechaMov,
                'DeleOrigen' => $request->DeleOrigen,
                'DeleDestino' => $request->DeleDestino,
                'DeptoOrigen' => $request->DeptoOrigen,
                'DeptoDestino' => $request->DeptoDestino
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Movimiento registrado exitosamente',
                'data' => $movimiento
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al registrar el movimiento',
                'error' => $e->getMessage()
            ], 500);
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

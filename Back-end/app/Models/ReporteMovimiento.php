<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReporteMovimiento extends Model
{
    use HasFactory;

    protected $primaryKey = 'ReporteID';
    protected $table = 'ReporteMovimiento';

    protected $fillable = [
        'ProductoID',
        'UsuarioID',
        'DeleOrigen',
        'DeleDestino',
        'DeptoOrigen',
        'DeptoDestino',
        'TipoMovID',
        'FechaMov'
    ];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'ProductosID');
    }

    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'TipoMovID');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioID');
    }

    // Evento para actualizar productos al crear un reporte de movimiento
    protected static function booted()
    {
        static::created(function ($movimiento) {
            $tipoBaja = TipoMovimiento::where('Descripcion', 'Baja')->first();

            if ($movimiento->TipoMovID == $tipoBaja->TipoMovID) {
                DB::table('Productos')
                    ->where('ProductoID', $movimiento->ProductoID)
                    ->update(['FechaBaja' => $movimiento->FechaMov]);
            }
        });
    }
}

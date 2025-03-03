<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteMovimiento extends Model
{
    protected $table = 'ReporteMovimiento';

    protected $fillable = [
        'ReporteID',
        'ProductoID',
        'UsuarioID',
        'DeleOrigen',
        'DeleDestino',
        'DeptoOrigen',
        'DeptoDestino',
        'TipoMovID',
        'FechaMov'
    ];
}

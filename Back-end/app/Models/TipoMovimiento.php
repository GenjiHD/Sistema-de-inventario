<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    protected $table = 'TipoMovimiento';

    protected $fillable = [
        'TipoMovID',
        'Descripcion'
    ];
}

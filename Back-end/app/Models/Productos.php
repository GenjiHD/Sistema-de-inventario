<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'Productos';

    protected $fillable = [
        'ProductoID',
        'NumeroControl',
        'NumeroSerie',
        'Descripcion',
        'Modelo',
        'Marca',
        'Categoria',
        'Factura',
        'Cantidad',
        'Valor'
    ];
}

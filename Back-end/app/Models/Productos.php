<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'Productos';
    protected $primaryKey = 'ProductoID';

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
        'FechaAlta',
        'FechaBaja',
        'Valor'
    ];
    public $timestamps = false;
}

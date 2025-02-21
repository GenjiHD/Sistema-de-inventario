<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'ProductoID';

    protected $fillable = [
        'NumeroControl',
        'NumeroSerie',
        'Descripcion',
        'Modelo',
        'Marca',
        'Categoria',
        'Factura',
        'Cantidad',
        'Valor',
    ];

    public $timestamps = true;
}

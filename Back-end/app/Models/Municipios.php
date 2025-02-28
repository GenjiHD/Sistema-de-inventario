<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = 'Municipios';

    protected $fillable = [
        'MunicipioID',
        'Descripcion'
    ];
}

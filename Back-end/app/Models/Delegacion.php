<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegacion extends Model
{
    protected $table = 'Delegaciones';

    protected $fillable = [
        'DelegacionID',
        'MunicipioID',
        'Descripcion'
    ];
}

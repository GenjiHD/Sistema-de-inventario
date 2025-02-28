<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'Departamentos';

    protected $fillable = [
        'DeptoID',
        'Descripcion'
    ];
}

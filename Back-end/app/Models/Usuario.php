<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'Usuario';

    // Clave primaria
    protected $primaryKey = 'UsuarioID';

    // Deshabilitar timestamps automáticos
    public $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'Nombre',       // Asegúrate de incluir 'Nombre' si es parte de la tabla
        'Contraseña',
        'Puesto',
        'Estado'
    ];

    // Ocultar la contraseña en las respuestas JSON
    protected $hidden = [
        'Contraseña',
    ];
}

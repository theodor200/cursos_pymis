<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilAlumno extends Model
{
    protected $table = 'perfil_alumnos';
    protected $fillable = [
        'id_empresa',
        'fecha_nacimiento',
        'dni',
        'celular',
        'cargo',
        'direccion'
    ];
}

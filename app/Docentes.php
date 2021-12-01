<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docentes extends Model
{
    protected $table = 'perfil_docentes';
    protected $fillable = [
        'dni',
        'fecha_nacimiento',
        'celular',
        'profesion',
        'grado',
        'centro_estudios',
        'estado'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion_Curso_Docente extends Model
{
    protected $table='asignacion_cursos';
    protected $fillable = [
        'id_docente',
        'id_curso',
        'id_categoria'
    ];
}

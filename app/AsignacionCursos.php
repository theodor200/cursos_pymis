<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionCursos extends Model
{
    protected $table = 'asignacion_cursos';

    protected $fillable = [
        'id_docente',
        'id_curso',
        'id_categoria',
        'campo_compuesto'
    ];
}

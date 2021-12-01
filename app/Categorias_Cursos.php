<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias_Cursos extends Model
{
    //
    protected $table = 'categorias_cursos';
    protected $fillable = [
        'nombre'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $table = 'modulos';
    protected $fillable = [
        'cursos_id',
        'nombre',
        'file',
        'estado'
    ];
}

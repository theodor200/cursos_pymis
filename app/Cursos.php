<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $fillable = [
        'id_categoria',
        'nombre',
        'promedio_minimo',
        'costo',
        'estado',
        'vacantes',
        'direccion',
        'id_departamento',
        'id_provincia',
        'id_distrito',
        'hora_curso',
        'fecha_inicio',
        'fecha_fin',
        'logotipo',
        'cat_nombre'
    ];

    public function curso_modulos(){
        return $this->hasMany(Modulos::class);
    }
}

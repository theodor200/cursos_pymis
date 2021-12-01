<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionesCursoAlumno extends Model
{
    protected $table = 'inscripciones';
    protected $fillable=[
      'id_curso',
      'user_id'
    ];

    public function notas(){
        return $this->hasOne(Notas::class,'inscripcion_id');
    }
}

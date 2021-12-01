<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    //
    protected $fillable = [
        'razon_social',
        'ruc',
        'correo',
        'direccion',
        'contacto',
        'rubro',
        'celular',
        'id_departamento',
        'id_provincia',
        'id_distrito',
        'estado'
    ];
}

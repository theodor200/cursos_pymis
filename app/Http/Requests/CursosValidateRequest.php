<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursosValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'costo'=>'required',
            'estado'=>'required',
            'vacantes'=>'required',
            'id_departamento'=>'required',
            'id_provincia'=>'required',
            'id_distrito'=>'required',
            'direccion'=>'required',
            'fecha_inicio'=>'required',
            'fecha_fin'=>'required',
            'cat_nombre' => 'required'
            //'cat_nombre' => 'required|unique:cursos,cat_nombre,'.$this->curso
        ];
    }

    public function messages()
    {
        return[
            'nombre.required' => 'Ingrese :attribute valido.',
            'costo.required'=>'Ingrese un :attribute valido.',
            'estado.required.required'=>'Ingrese un :attribute valido.',
            'vacantes.required'=>'Ingrese un número de :attribute.',
            'id_departamento.required'=>'Ingrese un :attribute valido.',
            'id_provincia.required'=>'Ingrese un :attribute valido.',
            'id_distrito.required'=>'Ingrese un :attribute valido.',
            'direccion.required'=>'Ingrese una :attribute valido.',
            'fecha_inicio.required'=>'Ingrese una :attribute valido.',
            'fecha_fin.required'=>'Ingrese una :attribute valido.',
            'cat_nombre.unique'=> ''
        ];
    }

    public function attributes()
    {
        return[
            'nombre' => 'nombre',
            'costo'=>'costo',
            'estado'=>'estado',
            'vacantes'=>'vacante',
            'id_departamento'=>'departamento',
            'id_provincia'=>'provincia',
            'id_distrito'=>'distrito',
            'direccion'=>'direccion',
            'fecha_inicio'=>'fecha de inicio',
            'fecha_fin'=>'fecha de fin',
            'cat_nombre'=>'categoría'
        ];
    }
}

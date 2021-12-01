<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaCursosValidateRequest extends FormRequest
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
            'nombre'=>'required|unique:categorias_cursos,nombre,'.$this->categoria_curso
        ];
    }

    public function messages()
    {
        return[
            'nombre.unique' => 'El :attribute ya existe, ingrese otro.'
        ];
    }

    public function attributes()
    {
        return[
            'nombre' => 'nombre de la categoría',
        ];
    }
}

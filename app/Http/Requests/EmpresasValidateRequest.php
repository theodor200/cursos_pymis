<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresasValidateRequest extends FormRequest
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
            'correo'=>'required|unique:empresas,correo,'.$this->empresa,
            'razon_social'=>'required|unique:empresas,razon_social,'.$this->empresa,
            'dominio'=>'required|unique:empresas,dominio,'.$this->empresa
        ];
    }

    public function messages()
    {
        return[
            'razon_social.unique' => 'La :attribute ya existe, ingrese otro.',
            'correo.unique' => 'EL :attribute ya existe, ingrese otro.',
            'dominio.unique' => 'EL :attribute ya existe, ingrese otro.'
        ];
    }

    public function attributes()
    {
        return[
            'correo' => 'correo electrónico de la empresa',
            'razon_social' => 'razón social de la empresa',
            'dominio' => 'dominio de la empresa'
        ];
    }
}

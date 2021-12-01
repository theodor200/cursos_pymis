<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class PerfilDocentesValidateRequest extends FormRequest
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
            'nombres'=>'required',
            'apellidos'=>'',
            'email' => ['required_if:user_id,==,""','string', 'email', 'max:255', 'unique:users,email'],
            'email_update' => ['required_if:user_id,>,0','string', 'email', 'max:255', 'unique:users,email,'.$this->user_id],
            'password' => ['required_if:user_id,==,""','string','min:8'],
            'password_update' => $this->password_update =='' ? '' : ['string','min:8']
        ];
    }

    public function messages()
    {
        return[
            'nombres.required' => 'Ingrese un :attribute.',
            'apellidos' => '',
            'password.required' =>'Ingrese una contraseña.',
            'password.min' =>'Ingrese una contraseña con 8 caracteres como mínimo.',
            'password_update.min' =>'La contraseña a actualizar debe tener 8 caracteres como mínimo.',
            'email.unique'=>'El correo electrónico ya esta registrado',
            'email_update.unique'=>'El correo electrónico a actualizar ya esta registrado, ingrese otro.'
        ];
    }

    public function attributes()
    {
        return[
            'nombres' => 'nombre del docente',
            'apellidos' => '',
        ];
    }
}

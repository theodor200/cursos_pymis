<?php

namespace App\Http\Controllers;

use App\Mail\MailUpdatePerfilDocente;
use App\Mail\MailUpdateUserDocente;
use Illuminate\Http\Request;
use App\PerfilDocente;
use App\User;
use App\Http\Requests\PerfilDocentesValidateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PerfilDocenteController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil_docente = PerfilDocente::findOrFail($id);
        $user = User::find($perfil_docente->user_id);
        return view('perfil_docente.edit', ['docente'=>$perfil_docente,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilDocentesValidateRequest $request, $id)
    {
        $user = User::findOrFail($request['user_id']);
        $user->name = $request['nombres'];
        if(strlen($request['password_update']) >= 8) {
            $user->password = Hash::make($request['password_update']);
        }
        $user->save();
        $data_user = ['id'=>$user->id,'name'=>$user->name,'email' => $user->email, 'password'=>$request['password_update'],'admin'=>false];

        if(strlen($request['password_update']) >= 8){
            Mail::to($user->email)->send(new MailUpdateUserDocente($data_user));
        }

        $perfil = PerfilDocente::findOrFail($id);
        $perfil->dni = $request['dni'];
        $perfil->fecha_nacimiento = $request['fecha_nacimiento'];
        $perfil->celular = $request['celular'];
        $perfil->profesion = $request['profesion'];
        $perfil->grado = $request['grado'];
        $perfil->centro_estudios = $request['centro_estudios'];

        $perfil->save();
        Mail::to($user->email)->send(new MailUpdatePerfilDocente($data_user));

    }
}

<?php

namespace App\Http\Controllers;

use App\Empresas;
use App\Http\Requests\PerfilAlumnosValidateRequest;
use App\Mail\MailUpdatePerfilAlumno;
use App\Mail\MailUpdateUserAlumno;
use App\PerfilAlumno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PerfilAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil_alumno = PerfilAlumno::findOrFail($id);
        $user = User::find($perfil_alumno->user_id);
        return view('perfil_alumno.edit', ['alumno'=>$perfil_alumno,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilAlumnosValidateRequest $request, $id)
    {
        $user = User::findOrFail($request['user_id']);
        $user->name = $request['nombres'];
        if(strlen($request['password_update']) >= 8) {
            $user->password = Hash::make($request['password_update']);
        }
        $user->save();

        $empresa = Empresas::findOrFail($request['id_empresa']);
        $nombre_empresa = $empresa->razon_social;
        $data_user = ['empresa'=>$nombre_empresa,'id'=>$user->id,'name'=>$user->name,'email' => $user->email, 'password'=>$request['password_update'],'admin'=>false];

        if(strlen($request['password_update']) >= 8){
            Mail::to($user->email)->send(new MailUpdateUserAlumno($data_user));
        }

        $perfil = PerfilAlumno::findOrFail($id);
        $perfil->id_empresa = $request['id_empresa'];
        $perfil->fecha_nacimiento = $request['fecha_nacimiento'];
        $perfil->dni = $request['dni'];
        $perfil->celular = $request['celular'];
        $perfil->cargo = $request['cargo'];
        $perfil->direccion = $request['direccion'];
        $perfil->save();

        Mail::to($user->email)->send(new MailUpdatePerfilAlumno($data_user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

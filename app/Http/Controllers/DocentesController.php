<?php

namespace App\Http\Controllers;

use App\Docentes;
use App\Mail\MailUpdatePerfilDocente;
use App\Mail\MailUpdateUserDocente;
use App\Mail\WelcomeMailDocente;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\DocentesValidateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes =  Docentes::all()->sortByDesc('created_at');
        return view('docentes.index',['docentes' => $docentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocentesValidateRequest $request)
    {
        $user = User::create([
            'name' => $request['nombres'].' '.$request['apellidos'],
            'email' => $request['email'],
            'role' => 'docente',
            'email_verified_at'=> date("Y-m-d H:i:s"),
            'password' => Hash::make($request['password']),
        ]);
        $user->perfil_docente()->create([
            'dni' =>$request['dni'],
            'fecha_nacimiento' =>$request['fecha_nacimiento'],
            'celular' =>$request['celular'],
            'profesion' =>$request['profesion'],
            'grado' =>$request['grado'],
            'centro_estudios' =>$request['centro_estudios'],
            'estado' =>$request['estado']
        ]);
        $data_user = ['name'=>$user->name,'email' => $user->email, 'password'=>$request['password']];
        Mail::to($user->email)->send(new WelcomeMailDocente($data_user));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function show(Docentes $docentes, $id)
    {
        $docente= Docentes::findOrFail($id);
        return view('docentes.show',compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil_docente = Docentes::findOrFail($id);
        $user = User::find($perfil_docente->user_id);
        return view('docentes.edit', ['docente'=>$perfil_docente,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function update(DocentesValidateRequest $request, $id)
    {
        $user = User::findOrFail($request['user_id']);
        $user->name = $request['nombres'];
        if(strlen($request['password_update']) >= 8) {
            $user->password = Hash::make($request['password_update']);
        }
        $user->save();
        $data_user = ['id'=>$user->id,'name'=>$user->name,'email' => $user->email, 'password'=>$request['password_update'],'admin'=>true];

        if(strlen($request['password_update']) >= 8){
            Mail::to($user->email)->send(new MailUpdateUserDocente($data_user));
        }

        $perfil = Docentes::findOrFail($id);
        $perfil->dni = $request['dni'];
        $perfil->fecha_nacimiento = $request['fecha_nacimiento'];
        $perfil->celular = $request['celular'];
        $perfil->profesion = $request['profesion'];
        $perfil->grado = $request['grado'];
        $perfil->centro_estudios = $request['centro_estudios'];
        $perfil->estado = $request['estado'];

        $perfil->save();
        Mail::to($user->email)->send(new MailUpdatePerfilDocente($data_user));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil_docente = DB::table('perfil_docentes')->where('user_id','=',$id)->first();
        $asignaciones = DB::table('asignacion_cursos')->where('id_docente','=',$id)->count();
        if($asignaciones > 0){
            return ['mensaje'=>'No está permitido eliminar este docente por tener cursos asignados.'];
        }
        User::findOrFail($id)->delete();
    }
}

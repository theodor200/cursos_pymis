<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\InscripcionesCursoAlumno;
use App\Mail\MailUpdateNotas;
use App\Notas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\Notas  $notas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumnos = InscripcionesCursoAlumno::where('id_curso','=',$id)->get();
        $curso = Cursos::where('id','=',$id)->first();
        return view ('registrar_notas.edit', ['alumnos'=>$alumnos,'curso'=>$curso]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notas  $notas
     * @return \Illuminate\Http\Response
     */
    public function show_notas_alumno($id)
    {
        $inscripcion = InscripcionesCursoAlumno::where('user_id','=',$id)->get();
        return view ('ver_notas.show_notas', ['inscripciones'=>$inscripcion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notas  $notas
     * @return \Illuminate\Http\Response
     */
    public function edit(Notas $notas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notas  $notas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ins = \App\InscripcionesCursoAlumno::where('id','=',$id)->first();
        $user = \App\User::where('id','=',$ins->user_id)->first();

        $notas = Notas::find($id);
        $notas->nota1 = $request['nota1'];
        $notas->nota2 = $request['nota2'];
        $notas->nota3 = $request['nota3'];
        $notas->nota4 = $request['nota4'];
        $notas->promedio = $request['promedio'];
        $notas->save();
        Mail::to($user->email)->send(new MailUpdateNotas($notas));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notas  $notas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notas $notas)
    {
        //
    }
}

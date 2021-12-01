<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\InscripcionesCursoAlumno;
use App\Mail\WelcomeMailCursoAlumno;
use App\Mail\ByeMailCursoAlumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InscripcionesCursoAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cursos = Cursos::where('estado','=','Activo')->get();
      return view('inscripcioncursoalumno.index',compact('cursos'));
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
        $curso = Cursos::where('id','=',$request['curso'])->first();
        $inscripcion = InscripcionesCursoAlumno::create([
            'id_curso'=>$request['curso'],
            'user_id'=>$request['user']
        ]);
        $inscripcion->save();
        $inscripcion->notas()->create();
        Mail::to(Auth::user()->email)->send(new WelcomeMailCursoAlumno($curso));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InscripcionesCursoAlumno  $inscripcionesCursoAlumno
     * @return \Illuminate\Http\Response
     */
    public function show(InscripcionesCursoAlumno $inscripcionesCursoAlumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InscripcionesCursoAlumno  $inscripcionesCursoAlumno
     * @return \Illuminate\Http\Response
     */
    public function edit(InscripcionesCursoAlumno $inscripcionesCursoAlumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InscripcionesCursoAlumno  $inscripcionesCursoAlumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InscripcionesCursoAlumno $inscripcionesCursoAlumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InscripcionesCursoAlumno  $inscripcionesCursoAlumno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ins = InscripcionesCursoAlumno::where('id','=',$id)->first();
        $curso = Cursos::find($ins->id_curso);
        InscripcionesCursoAlumno::find($id)->delete();
        Mail::to(Auth::user()->email)->send(new ByeMailCursoAlumno($curso));
    }
}

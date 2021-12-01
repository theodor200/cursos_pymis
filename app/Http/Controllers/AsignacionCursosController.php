<?php

namespace App\Http\Controllers;

use App\AsignacionCursos;
use App\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignacionCursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acursos = AsignacionCursos::all()->sortByDesc('created_at');
        return view('asignacion_cursos.index',compact('acursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asignacion_cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campo_compuesto=$request['id_categoria'].$request['id_curso'].$request['id_docente'];

        $curso = Cursos::where('id','=',$request['id_curso'])->first();
        $count = AsignacionCursos::where('campo_compuesto','=',$campo_compuesto)->count();

        if(($curso->estado == 'Activo' || $curso->estado == 'Inactivo') && $count == 0){
            $asignacion_save = AsignacionCursos::create([
                'id_curso' => $request['id_curso'],
                'id_docente' => $request['id_docente'],
                'id_categoria' => $request['id_categoria'],
                'campo_compuesto' => $campo_compuesto
            ]);
            $asignacion_save->save();
        }else{
             return ['mensaje'=>'Solo esta permitido asignar un docente por curso. Elija otro docente para este curso.'];
        }
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
        $asignacion_curso = AsignacionCursos::findOrFail($id);
        return view('asignacion_cursos.edit',['asignacion_curso' =>$asignacion_curso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asignacion = AsignacionCursos::findOrFail($id);
        $asignacion->id_curso = $request['id_curso'];
        $asignacion->id_docente = $request['id_docente'];
        $asignacion->id_categoria = $request['id_categoria'];
        $asignacion->campo_compuesto = $request['id_categoria'].$request['id_curso'].$request['id_docente'];
        $asignacion->save();
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

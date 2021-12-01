<?php

namespace App\Http\Controllers;

use App\Asignacion_Curso_Docente;
use Illuminate\Http\Request;

class AsignacionCursoDocenteController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Asignacion_Curso_Docente  $asignacion_Curso_Docente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Asignacion_Curso_Docente::where('id_docente','=',$id)->get();
        return view('asignacioncursosdocente.show',compact('data'));
    }

}

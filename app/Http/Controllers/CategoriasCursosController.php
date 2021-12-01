<?php

namespace App\Http\Controllers;

use App\Categorias_Cursos;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaCursosValidateRequest;
use Illuminate\Support\Facades\DB;


class CategoriasCursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catCursos =  Categorias_Cursos::all()->sortByDesc('created_at');
        return view('categorias_cursos.index',['catcursos' => $catCursos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias_cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaCursosValidateRequest $request)
    {
        $catCursos = request()->except('_token');
        Categorias_Cursos::insert($catCursos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorias_Cursos  $categorias_Cursos
     * @return \Illuminate\Http\Response
     */
    public function show(Categorias_Cursos $categorias_Cursos ,$id)
    {
        $catCurso= Categorias_Cursos::findOrFail($id);
        return view('categorias_cursos.show',compact('catCurso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorias_Cursos  $categorias_Cursos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria_curso = Categorias_Cursos::findOrFail($id);
        return view('categorias_cursos.edit', compact('categoria_curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorias_Cursos  $categorias_Cursos
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaCursosValidateRequest $request, $id)
    {
        $data_categoria_curso =  request()->except(['_token','_method','_id']);
        $categoria_curso = Categorias_Cursos::find($id)->update($data_categoria_curso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorias_Cursos  $categorias_Cursos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inscripciones = DB::table('cursos')->where('id_categoria','=',$id)->count();
        if($inscripciones > 0){
            return ['mensaje'=>'Esta categoría tiene cursos asignados, no se puede eliminar.'];
        }
        Categorias_Cursos::findOrFail($id)->delete();
    }
}

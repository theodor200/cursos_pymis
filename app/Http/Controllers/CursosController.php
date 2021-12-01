<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\Modulos;
use Illuminate\Http\Request;
use App\Http\Requests\CursosValidateRequest;
use Illuminate\Support\Facades\DB;


class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos =  Cursos::all()->sortByDesc('created_at');
        return view('cursos.index',[
            'cursos' => $cursos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * CursosValidateRequest
     */
    public function store( Request $request)
    {   
            $file = $request->file('logotipo');
            if($file!=null){
                $extension = $file->getClientOriginalExtension();
                $fileName =  strtotime(now()).'-'.rand(100,999). '.' . $extension;
                $image = \Storage::disk('public')->put($fileName,  \File::get($file)); 
                $logotipo = $fileName;
                
            }else{
                $logotipo = NULL;
            }

        $duplicado_activo = Cursos::where([['cat_nombre','=',$request['cat_nombre']],['estado','=','Activo']])->count();
        $duplicado_inactivo = Cursos::where([['cat_nombre','=',$request['cat_nombre']],['estado','=','Inactivo']])->count();
        $terminado = Cursos::where([['cat_nombre','=',$request['cat_nombre']],['estado','=','Terminado']])->count();
        if($duplicado_activo > 0 || $duplicado_inactivo > 0 ){
            return ['mensaje'=>'Ya existe un curso con este nombre en la categoría elegida. Ingrese otro nombre.'];
        }elseif($terminado >=0 ){
            $datosCurso = request()->except('_token','_method');
            $curso = Cursos::create([
                'id_categoria'=>$request['id_categoria'],
                'nombre'=>$request['nombre'],
                'promedio_minimo'=>$request['promedio_minimo'],
                'costo'=>$request['costo'],
                'estado'=>$request['estado'],
                'vacantes'=>$request['vacantes'],
                'direccion'=>$request['direccion'],
                'id_departamento'=>$request['id_departamento'],
                'id_provincia'=>$request['id_provincia'],
                'id_distrito'=>$request['id_distrito'],
                'hora_curso'=>$request['hora'],
                'fecha_inicio'=>$request['fecha_inicio'],
                'fecha_fin'=>$request['fecha_fin'],
                'logotipo' => $logotipo,
                'cat_nombre'=>$request['cat_nombre']
            ]);
            $curso->curso_modulos()->create();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function show(Cursos $cursos, $id)
    {
        $curso = Cursos::findOrFail($id);
        return view('cursos.show', compact('curso'));
    }

    public function getCursos(Request $request,$id)
    {
            $curso = Cursos::where('id_categoria','=',$id)->where('estado','=','Activo')->get();
            return response()->json($curso);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Cursos::findOrFail($id);
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $duplicado_activo = Cursos::whereNotIn('id',[$id])->where([['cat_nombre','=',$request['cat_nombre']],['estado','=','Activo']])->count();
        $duplicado_inactivo = Cursos::whereNotIn('id',[$id])->where([['cat_nombre','=',$request['cat_nombre']],['estado','=','Inactivo']])->count();
        $terminado = Cursos::where([['cat_nombre','=',$request['cat_nombre']],['estado','=','Terminado']])->count();
        if($duplicado_activo > 0 || $duplicado_inactivo > 0 ){
            return ['mensaje'=>'Ya existe un curso con este nombre en la categoría elegida. Ingrese otro nombre.'];
        }elseif($terminado >=0 ){
            $dataCurso =  request()->except(['_token','_method','_id']);
            $curso = Cursos::find($id)->update($dataCurso);
        }
    }

    public function update_logotipo(Request $request){
        
        $file = $request->file('logotipo');
        $extension = $file->getClientOriginalExtension();
        $fileName =  strtotime(now()).'-'.rand(100,999). '.' . $extension;
        $image = \Storage::disk('public')->put($fileName,  \File::get($file));           
        if($image){
            $logotipo = $fileName;
        }else{
            $logotipo = NULL;
        }
        $id = $request->_id;
        $curso = Cursos::find($id);
        $curso->logotipo = $fileName;
        $curso->save();
        return response()->json(['img'=>$fileName,'estado'=>'ok']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $inscripciones = DB::table('inscripciones')->where('id_curso','=',$id)->count();
        if($inscripciones > 0){
            return ['mensaje'=>'No esta permitido eliminar este curso por tener alumnos inscritos.'];
        }
        Cursos::findOrFail($id)->delete();
    }

}

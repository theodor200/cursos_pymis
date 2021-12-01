<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\Modulos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $curso = Cursos::findOrFail($id);
        $modulos = Modulos::where('cursos_id','=',$id)->get();
        return view('modulo.index',compact(['curso','modulos']));
    }

    public function index_alumno($id)
    {
        $curso = Cursos::findOrFail($id);
        $modulos = Modulos::where('cursos_id','=',$id)->get();
        return view('modulo.modulo_alumno',compact(['curso','modulos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       $curso = Cursos::findOrFail($id);
        return view('modulo.create',compact('curso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $date = date('Y-m-d_h-i-s');
        $nombre_file = $date.'_'.$file->getClientOriginalName();
        $file->move(public_path('files/'),$nombre_file);
        $modulo = Modulos::create([
            'cursos_id'=>$request['_id'],
            'nombre'=>$request['nombre'],
            'file'=>$nombre_file,
            'estado'=>$request['estado']
        ]);
        $modulo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modulos  $modulos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modulos  $modulos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modulo = Modulos::findOrFail($id);
        $curso = Cursos::findOrFail($modulo->cursos_id);
        return view('modulo.edit',compact(['modulo','curso']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulos  $modulos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $modulo = Modulos::findOrFail($id);
        $modulo->nombre = $request['nombre'];
        $modulo->estado = $request['estado'];

        $file = $request->file('file');
        if(empty($file)){
            $modulo->save();
        }else{
            $path = public_path('files/').$modulo->file;
            File::delete($path);

            $file_update = $request->file('file');
            $date = date('Y-m-d_h-i-s');
            $nombre_file = $date.'_'.$file_update->getClientOriginalName();
            $file_update->move(public_path('files/'),$nombre_file);
            $modulo->file = $nombre_file;
            $modulo->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulos  $modulos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file =  Modulos::findOrFail($id);
        $path = public_path('files/').$file->file;
        File::delete($path);
        Modulos::findOrFail($id)->delete();
    }
}

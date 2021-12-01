<?php

namespace App\Http\Controllers;

use App\Empresas;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresasValidateRequest;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas =  Empresas::all()->sortByDesc('created_at');
        return view('empresas.index',[
            'empresas' => $empresas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresasValidateRequest $request)
    {
        $datosEmpresa = request()->except('_token','_method');
        Empresas::insert($datosEmpresa);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show(Empresas $empresas,$id)
    {
        $empresa = Empresas::findOrFail($id);
        return view('empresas.show',compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresas::findOrFail($id);
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresasValidateRequest $request, $id)
    {
        $dataEmpresa =  request()->except(['_token','_method','dominio','_id']);
        $empresa = Empresas::find($id)->update($dataEmpresa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $inscripciones = DB::table('perfil_alumnos')->where('id_empresa','=',$id)->count();
        if($inscripciones > 0){
            return ['mensaje'=>'No está permitido eliminar esta empresa por tener alumnos registrados.'];
        }
        Empresas::findOrFail($id)->delete();

    }
}

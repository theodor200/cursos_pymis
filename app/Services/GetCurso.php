<?php

namespace App\Services;

use App\Cursos;
use Illuminate\Support\Facades\DB;

class GetCurso{

    /*
     * Extrae todos los nombres y id de la tabla departamentos
     *
     * */

    public function getCurso($filter_count_curso=false, $id = null, $id_categoria = null){
        if($filter_count_curso==false){

        }else {
            if($id == null){
                $catcursos = DB::table('cursos')->where(
                    ['id_categoria','=',$id_categoria],
                    ['estado','=','Activo']
                    )->get();
            }else {
                $defult_id = DB::table('cursos')->where('id','=',$id)->where('id_categoria','=',$id_categoria)->first()->id;
                $defult_nombre =DB::table('cursos')->where('id','=',$id)->where('id_categoria','=',$id_categoria)->first()->nombre;
                $cursosArray[$defult_id] = $defult_nombre;

                $cursos =DB::table('cursos')
                    ->whereNotIn('id', [$id])
                    ->where(['id_categoria','=',$id_categoria],['estado','=','Activo'])
                    ->get();
            }
            foreach ($cursos as $curso) {
                $cursosArray[$curso->id] = strtoupper($curso->nombre);
            }
        }
        return $cursosArray;
    }
}

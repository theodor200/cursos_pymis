<?php

namespace App\Services;

use App\Categorias_Cursos;
use Illuminate\Support\Facades\DB;

class GetCategoriaCurso{

    /*
     * Extrae todos los nombres y id de la tabla departamentos
     *
     * */

    public function getCategoria($filter_count_curso=false, $execpt = null){
        if($filter_count_curso==false){
            $categorias = Categorias_Cursos::get();
            $categoriasArray[''] = 'Selecciona una categoría';
            foreach ($categorias as $categoria) {
                $id = $categoria->id;
                $categoriasArray[$id] = strtoupper($categoria->nombre);
            }

        }else {

            if($execpt == null){
                $catcursos = Categorias_Cursos::all();
            }else{
                $defult_id = DB::table('categorias_cursos')->where('id',$execpt)->first()->id;
                $defult_nombre = DB::table('categorias_cursos')->where('id',$execpt)->first()->nombre;

                $categoriasArray[$defult_id] = strtoupper($defult_nombre);
                $catcursos = DB::table('categorias_cursos')
                    ->whereNotIn('id', [$execpt])
                    ->get();
            }

            foreach ($catcursos as $catcurso) {
                $id = $catcurso->id;
                $count_curso = DB::table('cursos')->where('id_categoria','=',$id)->count();
                if($count_curso > 0){
                    $categoriasArray[$id] = strtoupper($catcurso->nombre);
                }
            }
        }
        return $categoriasArray;
    }
}

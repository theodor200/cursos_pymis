<?php

namespace App\Services;

use App\Departamentos;
use App\Provincias;
use App\Distritos;

class GetUbicacion{

    /*
     * Extrae todos los nombres y id de la tabla departamentos
     *
     * */

    public function getDepartamento($id = 0){
        if($id == 0){
            $departamentos = Departamentos::get();
            $departamentosArray[''] = 'Selecciona un departamento';
            foreach ($departamentos as $departamento){
                $idd=strval($departamento['id']);
                $id = str_pad($idd, 2, "0", STR_PAD_LEFT);
                $departamentosArray[$id] = $departamento['nombre'];
            }
        }else{
            $departamento = Departamentos::where('id',$id)->first();

                $idd=strval($departamento['id']);
                $id = str_pad($idd, 2, "0", STR_PAD_LEFT);
                $departamentosArray[$id] = $departamento['nombre'];

        }
        return $departamentosArray;
    }

    public function getProvincia($id){
        $provincia = Provincias::where('id',$id)->first();
        $id = str_pad($provincia['id'], 2, "0", STR_PAD_LEFT);
        $provinciasArray[$id] = $provincia['nombre'];
        return $provinciasArray;
    }

    public function getDistrito($id){
        $distrito = Distritos::where('id','=',$id)->first();
        $id = str_pad($distrito['id'], 2, "0", STR_PAD_LEFT);
        $distritosArray[$id] = $distrito['nombre'];
        return $distritosArray;
    }


}
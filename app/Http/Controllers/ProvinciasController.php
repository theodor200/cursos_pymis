<?php

namespace App\Http\Controllers;

use App\Provincias;
use Illuminate\Http\Request;

class ProvinciasController extends Controller
{

    public function getProvincias(Request $request){
        if($request->ajax()) {
            $provincias = Provincias::where('id_departamento', $request->id)->get();

            foreach ($provincias as $provincia) {
                $id = str_pad($provincia->id, 4, "0", STR_PAD_LEFT);
                $provinciaArray [$id] = $provincia->nombre;
            }
            return response()->json($provinciaArray);
        }
    }
}

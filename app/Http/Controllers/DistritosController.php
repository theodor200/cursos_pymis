<?php

namespace App\Http\Controllers;

use App\Distritos;
use Illuminate\Http\Request;

class DistritosController extends Controller
{
    public function getDistritos(Request $request){
        if($request->ajax()) {

            $distritos = Distritos::where('id_provincia', $request->id)->get();
            foreach ($distritos as $distrito) {
                $id = str_pad($distrito->id, 6, "0", STR_PAD_LEFT);
                $distritoArray [$id] = $distrito->nombre;
            }
            return response()->json($distritoArray);
        }
    }
}

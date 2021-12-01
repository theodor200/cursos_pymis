<?php

namespace App\Http\Controllers;

use App\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use Barryvdh\DomPDF\Facade as PDF;

class CertificadoController extends Controller
{
    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id,$user)
    {
           
        $curso = Cursos::find($id);
        if($user == 'cert'){
            $alumno = Auth::user();
        }else{
            $alumno = User::findOrFail($user);
        }
        
        if($curso->estado == 'Terminado'){
            $pdf = PDF::loadView('certificado.show',['alumno'=>$alumno,'curso'=>$curso]);
            $pdf->setPaper('a4','portrait');
            return $pdf->download('certificado_capacitacion_pymis_curso_'.$curso->nombre.'.pdf');
            //return $pdf->stream();

        }else{
            return view ('certificado.show', ['aviso'=>'No se puede generar un certificado, si el curso no ha terminado.']);
        }
    }

    public function ejemplo($id)
    {
           
        $curso = Cursos::find($id);
        $pdf = PDF::loadView('certificado.certificado',['curso'=>$curso]);
        $pdf->setPaper('a4','portrait');
        return $pdf->download('certificado_ejemplo_capacitacion_pymis_curso_'.$curso->nombre.'.pdf');           
        
    }
}

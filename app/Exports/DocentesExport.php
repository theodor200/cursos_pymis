<?php

namespace App\Exports;

use App\Docentes;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\WithMapping;

class DocentesExport implements FromCollection, WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $docentes = User::select(
            'users.name','users.email','users.role',
            'perfil_docentes.dni','perfil_docentes.fecha_nacimiento','perfil_docentes.celular',
            'perfil_docentes.profesion','perfil_docentes.grado','perfil_docentes.centro_estudios',
            'perfil_docentes.estado','perfil_docentes.created_at','perfil_docentes.updated_at'
        )->join('perfil_docentes',function($join){
            $join->on('users.id','=','perfil_docentes.user_id')
                ->where('users.role','=','docente');
        })->get();
        return $docentes;
    }

    public function headings(): array
    {
        return [
            //'#',
            'Nombres y apellidos',
            'Correo electrónico',
            'Tipo de usuario',
            'Número de DNI',
            'Fecha de nacimiento',
            'Número de celular',
            'Profesión',
            'Grado de instrucción académica',
            'Centro de estudios',
            'Estado del docente',
            'Fecha de creación del registro',
            'Fecha de última actualización del registro'
        ];
    }
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }



}

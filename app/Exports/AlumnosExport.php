<?php

namespace App\Exports;

use App\Alumnos;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AlumnosExport implements FromCollection, WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $alumnos = DB::table('perfil_alumnos')

            //->join('empresas','perfil_alumnos.id_empresa','=','empresas.id')
            ->join('users','perfil_alumnos.user_id','=','users.id')
            /*->join('empresas', function ($join) {
                $join->on('perfil_alumnos.id_empresa', '=', 'empresas.id');
            })*/
            ->select(
                DB::Raw('IF( EXISTS(
                                        SELECT razon_social as ra FROM empresas WHERE id = perfil_alumnos.id_empresa
                                    ),(SELECT razon_social as ra FROM empresas WHERE id = perfil_alumnos.id_empresa),""
                             )'),
                'users.role as role','users.name as nombre','users.email as email',
            'perfil_alumnos.dni','perfil_alumnos.direccion','perfil_alumnos.fecha_nacimiento','perfil_alumnos.celular',
            'perfil_alumnos.cargo','perfil_alumnos.created_at','perfil_alumnos.updated_at'
        )->get();

        return $alumnos;
    }

    public function headings(): array
    {
        return [
            //'#',
            'Empresa',
            'Tipo de usuario',
            'Nombres y apellidos',
            'Correo electrónico',
            'Número de DNI',
            'Dirección',
            'Fecha de nacimiento',
            'Número de celular',
            'Cargo',
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

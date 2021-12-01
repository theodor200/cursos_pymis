<?php

namespace App\Exports;

use App\Empresas;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EmpresasExport implements FromCollection, WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $empresas=DB::table('empresas')
            ->join('departamentos','empresas.id_departamento','=','departamentos.id')
            ->join('provincias','empresas.id_provincia','=','provincias.id')
            ->join('distritos','empresas.id_distrito','=','distritos.id')
            ->select(
                'empresas.razon_social','empresas.ruc','empresas.rubro',
                'departamentos.nombre as Departamento','provincias.nombre as Provincia','distritos.nombre as Distrito',
                'empresas.direccion','empresas.correo','empresas.dominio',
                'empresas.contacto','empresas.celular','empresas.estado',
                'empresas.created_at','empresas.updated_at')
            ->get();

        return $empresas;
    }

    public function headings(): array
    {
        return [
            //'#',
            'Razón social',
            'R.U.C',
            'Rubro',
            'Departamento',
            'Provincia',
            'Distrito',
            'Dirección',
            'Correo electrónico',
            'Dominio',
            'Contácto',
            'Celular',
            'Estado',
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

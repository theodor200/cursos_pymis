<?php

namespace App\Exports;

use App\Cursos;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CursosExport implements FromCollection, WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $empresas=DB::table('cursos')
            ->join('categorias_cursos','cursos.id_categoria','=','categorias_cursos.id')
            ->join('departamentos','cursos.id_departamento','=','departamentos.id')
            ->join('provincias','cursos.id_provincia','=','provincias.id')
            ->join('distritos','cursos.id_distrito','=','distritos.id')
            ->select(
                'cursos.nombre','categorias_cursos.nombre as Categoria','cursos.costo','cursos.estado','cursos.vacantes',
                'departamentos.nombre as Departamento','provincias.nombre as Provincia','distritos.nombre as Distrito',
                'cursos.direccion','cursos.fecha_inicio','cursos.fecha_fin',
                'cursos.created_at','cursos.updated_at')
            ->get();

        return $empresas;
    }

    public function headings(): array
    {
        return [
            //'#',
            'Nombre del curso',
            'Categoría del curso',
            'Costo S/.',
            'Estado',
            'Vacantes',
            'Departamento',
            'Provincia',
            'Distrito',
            'Dirección',
            'Fecha incio de curso',
            'Fecha fin de curso',
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

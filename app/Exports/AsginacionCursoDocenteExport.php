<?php

namespace App\Exports;

use App\Asignacion_Curso_Docente;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AsginacionCursoDocenteExport implements FromCollection, WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $asignacion_cursos=DB::table('asignacion_cursos')
            ->join('categorias_cursos','asignacion_cursos.id_categoria','=','categorias_cursos.id')
            ->join('cursos','asignacion_cursos.id_curso','=','cursos.id')
            ->join('users','asignacion_cursos.id_docente','=','users.id')
            ->select(
                'categorias_cursos.nombre as categoria','cursos.nombre as curso','users.name as docente',
                'cursos.fecha_inicio','cursos.fecha_fin','cursos.estado',
                'asignacion_cursos.created_at','asignacion_cursos.updated_at')
            ->get();

        return $asignacion_cursos;
    }

    public function headings(): array
    {
        return [
            //'#',
            'Categoría del curso',
            'Nombre del curso',
            'Nombre del docente',
            'Fecha incio de curso',
            'Fecha fin de curso',
            'Estado del curso',
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

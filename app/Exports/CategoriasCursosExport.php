<?php

namespace App\Exports;

use App\Categorias_Cursos;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CategoriasCursosExport implements FromCollection, WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $categoria = DB::table('categorias_cursos')->select('nombre','created_at','updated_at')->get();
        return $categoria;
    }

    public function headings(): array
    {
        return [
            //'#',
            'Nombre de categoría',
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

<?php

namespace App\Console\Commands;

use App\Cursos;
use Illuminate\Console\Command;

class EstadoTerminadoCursos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'estadoterminado:cursos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza los cursos al estado terminado, si la fecha_fin del curso es menor a la fecha actual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $cursos = Cursos::all();
        $fecha_actual = date("Y-m-d");
        foreach ($cursos as $curso){
            $id = $curso->id;
            if(date($curso->fecha_fin) < $fecha_actual){
                $curso_update = Cursos::find($curso->id);
                $curso_update->estado = 'Terminado';
                $curso_update->save();
           }
        }

    }
}

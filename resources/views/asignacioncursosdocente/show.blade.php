@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="d-inline-block">Lista de mis cursos asignados.</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Categoría del curso</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Fecha de inicio</th>
                                <th scope="col">Fecha de fin</th>
                                <th scope="col">Estado del curso</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                @php
                                    $curso = \Illuminate\Support\Facades\DB::table('cursos')->where('id','=',$d->id_curso)->first();
                                    $categoria = \Illuminate\Support\Facades\DB::table('categorias_cursos')->where('id','=',$d->id_categoria)->first();
                                @endphp
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{isset($categoria->nombre) ? ucfirst($categoria->nombre) : '--'}}</td>
                                    <td>{{isset($curso->nombre) ? ucfirst($curso->nombre) : '--'}}</td>
                                    <td>{{isset($curso->fecha_inicio) ? $curso->fecha_inicio : '--'}}</td>
                                    <td>{{isset($curso->fecha_fin) ? $curso->fecha_fin : '--'}}</td>
                                    <td>{{isset($curso->estado) ? ucfirst($curso->estado) : ''}}</td>
                                    @if($curso->estado == 'Terminado')
                                        <td><a class="btn btn-secondary" href={{url("registrar_notas/".$d->id_curso)}}>Ver notas</a>
                                        <a class="btn btn-primary" href={{url("modulo_lista/".$d->id_curso)}}>Ver módulos</a></td>
                                    @else
                                       <td><a class="btn btn-primary" href={{url("registrar_notas/".$d->id_curso)}}>Registrar notas</a>
                                       <a class="btn btn-primary" href={{url("modulo_lista/".$d->id_curso)}}>Crear módulos</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript-optional')

@endsection

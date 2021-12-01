@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-inline-block">MIS NOTAS</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="align-middle">#</th>
                                <th scope="col" class="align-middle">Categoría del curso</th>
                                <th scope="col" class="align-middle">Curso</th>
                                <th scope="col" class="align-middle">Estado</th>
                                <th scope="col" class="align-middle">Nota 01</th>
                                <th scope="col" class="align-middle">Nota 02</th>
                                <th scope="col" class="align-middle">Nota 03</th>
                                <th scope="col" class="align-middle">Nota 04</th>
                                <th scope="col" class="align-middle">Promedio</th>
                                <th scope="col" class="align-middle" width="250">Certificado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inscripciones as $inscripcion)
                                @php
                                    $curso = \Illuminate\Support\Facades\DB::table('cursos')->where('id','=',$inscripcion->id_curso)->first();
                                    $categoria_curso = \Illuminate\Support\Facades\DB::table('categorias_cursos')->where('id','=',$curso->id_categoria)->first();
                                    $notas = \Illuminate\Support\Facades\DB::table('notas')->where('inscripcion_id','=',$inscripcion->id)->first();
                                @endphp
                                <tr>
                                    <th scope="row" class="align-middle">{{$loop->iteration}}</th>
                                    <td class="align-middle">
                                        {{strtoupper($categoria_curso->nombre)}}
                                    </td>
                                    <td class="align-middle">
                                        {{strtoupper($curso->nombre)}}
                                    </td>
                                    <td class="align-middle">
                                        {{strtoupper($curso->estado)}}
                                    </td>
                                    <td class="align-middle">
                                        <p>{{$notas->nota1}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <p>{{$notas->nota2}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <p>{{$notas->nota3}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <p>{{$notas->nota4}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <p>{{$notas->promedio}}</p>
                                    </td>
                                    @if($curso->estado == 'Terminado')
                                        @if($notas->promedio >= $curso->promedio_minimo)
                                            <td class="align-middle">
                                                <a class="btn btn-primary" target="_blank" href="{{url('ver_certificado/'.$curso->id.'/cert')}}">Ver certificado</a>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <b>Curso teminado.</b> <br> No aprobó el curso.
                                                <br><b>Promedio mínimo</b> para probar el curso era <b>{{ $curso->promedio_minimo }}</b>
                                            </td>
                                        @endif

                                    @else
                                        <td class="align-middle">
                                            <b>Curso en proceso ..</b> <br> Para aprobar el curso y descargar tu certificado el <b>promedio mínimo</b> es <b>{{ $curso->promedio_minimo }}</b>
                                        </td>
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

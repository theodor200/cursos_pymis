@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="d-inline-block">Lista de cursos registrados. </h2>
                        <a href="{{url('/cursos/create')}}" class="btn btn-primary btn-lg float-right ml-2">Crear curso</a>
                        <a href="{{url('/excel_cursos')}}" class="btn btn-secondary btn-lg float-right">Exportar a excel</a>
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
                                <th scope="col">Nombre del curso</th>
                                <th scope="col">Certificado</th>
                                <th scope="col">Promedio mínimo para aprobar</th>
                                <th scope="col">Costo en soles (S/.)</th>
                                <th scope="col">Estado del curso</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Provincia</th>
                                <th scope="col">Distrito</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Horas de curso</th>
                                <th scope="col">Fecha de inicio</th>
                                <th scope="col">Fecha de fin </th>
                                <th scope="col">N° de inscritos</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cursos as $curso)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{strtoupper(\Illuminate\Support\Facades\DB::table('categorias_cursos')->where('id','=',$curso->id_categoria)->first()->nombre)}}</td>
                                        <td>{{strtoupper($curso->nombre)}}</td>
                                        <td>
                                            @if($curso->logotipo == NULL)
                                                <a class="btn btn-secondary btn-sm" href="{{ asset('storage/logo-pymis.png')}}" target="_blank">Ver logotipo</a>
                                            @else
                                                <a class="btn btn-secondary btn-sm" href="{{ asset('storage/'.$curso->logotipo)}}" target="_blank">Ver logotipo</a>
                                            @endif
                                            
                                            <a class="btn btn-secondary btn-sm mt-3" href="{{ url('ver_certificado_ejemplo/'.$curso->id.'/curso')}}">Certificado ejemplo</a>
                                        </td>
                                        <td>{{strtoupper($curso->promedio_minimo)}}</td>
                                        <td>S/. {{strtoupper($curso->costo)}}</td>
                                        <td>{{strtoupper($curso->estado)}}</td>
                                        <td>@foreach($GetUbicacion->getDepartamento($curso->id_departamento) as $index => $departamento)
                                                    {{ strtoupper($departamento) }}
                                            @endforeach</td>
                                        <td>@foreach($GetUbicacion->getProvincia($curso->id_provincia) as $index => $provincia)
                                                {{ strtoupper($provincia) }}
                                            @endforeach</td>
                                        <td>
                                            @foreach($GetUbicacion->getDistrito($curso->id_distrito) as $index => $distrito)
                                                {{ strtoupper($distrito) }}
                                            @endforeach

                                        </td>
                                        <td>{{strtoupper($curso->direccion)}}</td>
                                        <td>{{strtoupper($curso->hora_curso)}}</td>
                                        <td>{{strtoupper($curso->fecha_inicio)}}</td>
                                        <td>{{strtoupper($curso->fecha_fin)}}</td>
                                        <td>{{\Illuminate\Support\Facades\DB::table('inscripciones')->where('id_curso','=',$curso->id)->count()}}</td>

                                        <td>
                                            @if($curso->estado == 'Terminado')
                                                <a class="d-block float-left mx-2" href="{{ url('cursos/'.$curso->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                                            @else
                                                <a class="d-block float-left mx-2" href="{{ url('cursos/'.$curso->id.'/edit')}}"><ion-icon size="large" name="create-outline"></ion-icon></a>
                                                <a class="d-block float-left mx-2" href="{{ url('cursos/'.$curso->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                                                <a class="delete d-block float-left mx-2" href="{{ url('cursos/'.$curso->id)}}"><ion-icon size="large" name="trash-outline"></ion-icon></a>
                                            @endif
                                        </td>
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
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script>
        (function() {
            'use strict';
            const url = location.protocol+'//'+location.hostname+'/'
            window.addEventListener('load', function() {

                $(".delete").click(function(e){
                    e.preventDefault()
                    if (window.confirm("¿Desea borrar este curso?")) {
                        const _url = e.target.parentNode.getAttribute('href')
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: _url,
                            type: 'delete',
                            dataType: "JSON",
                            beforeSend: function(response){
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Eliminando registro ...');
                            },
                            complete: function (response){
                                if( response.responseText == ''){
                                    $('.modal-body').html('EL registro se eliminó con éxito.');
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/cursos');
                                }else{
                                    $('.modal-body').html(response.responseJSON.mensaje);
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            }, false);
        })();
    </script>
@endsection

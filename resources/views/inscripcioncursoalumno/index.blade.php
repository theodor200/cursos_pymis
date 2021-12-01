@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="d-inline-block">Lista de cursos para inscripciones. </h2>
                        <ul class="mt-3">
                            <li>Podrá inscribirse a los cursos que tengan el <b>ESTADO : ACTIVO</b></li>
                            <li><b>IMPORTANTE:</b> Tenga en cuenta que, al borrar un curso, también se eliminaran sus notas.</li>
                            <li>Se enviará una notificación a tu correo electrónico <b>{{\Illuminate\Support\Facades\Auth::user()->email}}</b> cuando te inscribas o borres un curso de tu perfil.</li>
                        </ul>
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
                            <th scope="col" class="align-middle">Nombre del curso</th>
                            <th scope="col" class="align-middle">Promedio mínimo para aprobar el curso</th>
                            <th scope="col" class="align-middle">Costo del curso en soles (S/.)</th>
                            <th scope="col" class="align-middle">Estado del curso</th>
                            <th scope="col" class="align-middle">Departamento</th>
                            <th scope="col" class="align-middle">Provincia</th>
                            <th scope="col" class="align-middle">Distrito</th>
                            <th scope="col" class="align-middle">Dirección</th>
                            <th scope="col" class="align-middle">Horas del curso</th>
                            <th scope="col" class="align-middle">Fecha de inicio</th>
                            <th scope="col" class="align-middle">Fecha de fin</th>
                            <th scope="col" class="align-middle">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cursos as $curso)
                            <tr>
                                <th scope="row" class="align-middle">{{$loop->iteration}}</th>
                                <td class="align-middle">{{strtoupper(\Illuminate\Support\Facades\DB::table('categorias_cursos')->where('id','=',$curso->id_categoria)->first()->nombre)}}</td>
                                <td class="align-middle">{{strtoupper($curso->nombre)}}</td>
                                <td class="align-middle">{{strtoupper($curso->promedio_minimo)}}</td>
                                <td class="align-middle">S/. {{strtoupper($curso->costo)}}</td>
                                <td class="align-middle">{{strtoupper($curso->estado)}}</td>
                                <td class="align-middle">@foreach($GetUbicacion->getDepartamento($curso->id_departamento) as $index => $departamento)
                                        {{ strtoupper($departamento) }}
                                    @endforeach</td>
                                <td class="align-middle">@foreach($GetUbicacion->getProvincia($curso->id_provincia) as $index => $provincia)
                                        {{ strtoupper($provincia) }}
                                    @endforeach</td>
                                <td class="align-middle">
                                    @foreach($GetUbicacion->getDistrito($curso->id_distrito) as $index => $distrito)
                                        {{ strtoupper($distrito) }}
                                    @endforeach

                                </td>
                                <td class="align-middle">{{strtoupper($curso->direccion)}}</td>
                                <td class="align-middle">{{strtoupper($curso->hora_curso)}}</td>
                                <td class="align-middle">{{strtoupper($curso->fecha_inicio)}}</td>
                                <td class="align-middle">{{strtoupper($curso->fecha_fin)}}</td>
                                <td class="align-middle">
                                    @if($curso->estado == 'Terminado')
                                        <p>Este curso termino.</p>
                                    @else
                                        @php
                                            $user_id=\Illuminate\Support\Facades\Auth::user()->id;
                                            $count=\App\InscripcionesCursoAlumno::where([['user_id','=',$user_id],['id_curso','=',$curso->id]])->count();
                                            $id_inscripcion=\App\InscripcionesCursoAlumno::where([['user_id','=',$user_id],['id_curso','=',$curso->id]])->first();
                                        @endphp
                                        @if($count>0)
                                            <a class="salir_curso btn btn-secondary d-block float-left mx-2 my-2"
                                               href="{{ url('inscripciones_cursos/'.$id_inscripcion->id)}}">Borrar</a>
                                            <a class="btn btn-secondary d-block float-left mx-2" href="{{url('/modulo/'.$curso->id.'/view')}}">Ver módulos</a>
                                        @else
                                            <a class="inscribirse btn btn-success d-block float-left mx-2 my-2" data-curso="{{$curso->id}}"
                                               data-categoria="{{$curso->id_categoria}}" data-user="{{\Illuminate\Support\Facades\Auth::user()->id}}"
                                               href="{{ url('inscripciones_cursos')}}">Inscribirse</a>
                                        @endif
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
    <script>
        (function() {
            'use strict';
            const url = location.protocol+'//'+location.hostname+'/'
            window.addEventListener('load', function() {
                $(".inscribirse").click(function(e){
                    e.preventDefault()
                        const _url = e.target.getAttribute('href')
                        const _curso = e.target.getAttribute('data-curso')
                        const _user = e.target.getAttribute('data-user')
                        let array={}
                        array['curso']=_curso
                        array['user']=_user
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: _url,
                            data:array,
                            type: 'post',
                            dataType: "JSON",
                            beforeSend: function(response){
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Enviando solicitud ...');
                            },
                            complete: function (response){
                                console.log(response)
                                if( response.responseText == ''){
                                    $('.modal-body').html('Se inscribió con éxito al curso.');
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/inscripciones_cursos');
                                }else{
                                    $('.modal-body').html(response.responseJSON.mensaje);
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });

                });

                $(".salir_curso").click(function(e){
                    e.preventDefault()
                    const _url = e.target.getAttribute('href')
                    if (window.confirm("¿Desea borrar su inscripción?")) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: _url,
                            type: 'delete',
                            dataType: "JSON",
                            beforeSend: function (response) {
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Enviando solicitud ...');
                            },
                            complete: function (response) {
                                console.log(response)
                                if (response.responseText == '') {
                                    $('.modal-body').html('Se borro su inscripción con éxito.');
                                    window.location.replace(window.location.protocol + '//' + window.location.hostname + '/inscripciones_cursos');
                                } else {
                                    $('.modal-body').html(response.responseJSON.mensaje);
                                }
                            },
                            error: function (xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            }, false);
        })();
    </script>
@endsection



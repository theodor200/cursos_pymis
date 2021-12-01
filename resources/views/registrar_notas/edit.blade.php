@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-inline-block"><b>CURSO: {{strtoupper($curso->nombre)}}</b></h5>
                        <p style="margin:0;">Este curso inicio el: <b>{{$curso->fecha_inicio}}</b></p>
                        <p style="margin:0;">Este curso termina el: <b>{{$curso->fecha_fin}}</b></p>
                        <p style="margin:0;">Estado actual del curso: <b>{{$curso->estado}}</b></p>
                        <br><b>Promedio mínimo</b> para probar el curso es <b>{{ $curso->promedio_minimo }}</b>
                        <br>La nota mínima es asigna por el administrador del sistema al momento de crear el curso.

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre(s) del alumno</th>
                                <th scope="col">Nota 01</th>
                                <th scope="col">Nota 02</th>
                                <th scope="col">Nota 03</th>
                                <th scope="col">Nota 04</th>
                                <th scope="col">Promedio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alumnos as $alumno)
                                @php
                                    $notas = \Illuminate\Support\Facades\DB::table('notas')->where('inscripcion_id','=',$alumno->id)->first();
                                    $user = \Illuminate\Support\Facades\DB::table('users')->where('id','=',$alumno->user_id)->first();
                                    //$notas = \Illuminate\Support\Facades\DB::table('notas')->where('inscripcion_id','=',$inscripcion->id)->first();

                                @endphp
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        {{ucwords($user->name)}}
                                    </td>
                                    <td>
                                        <select name="nota1" id="nota1" class="custom-select">
                                            @if($notas->nota1 == '0')
                                                <option value="00">00</option>
                                            @else
                                                <option value="{{$notas->nota1}}">{{$notas->nota1}}</option>
                                            @endif
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nota2" id="nota2" class="custom-select">
                                            @if($notas->nota2 == '0')
                                                <option value="00">00</option>
                                            @else
                                                <option value="{{$notas->nota2}}">{{$notas->nota2}}</option>
                                            @endif
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nota3" id="nota3" class="custom-select">
                                            @if($notas->nota3 == '0')
                                                <option value="00">00</option>
                                            @else
                                                <option value="{{$notas->nota3}}">{{$notas->nota3}}</option>
                                            @endif
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nota4" id="nota4" class="custom-select">
                                            @if($notas->nota4 == '0')
                                                <option value="00">00</option>
                                            @else
                                                <option value="{{$notas->nota4}}">{{$notas->nota4}}</option>
                                            @endif
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="w-25 text-center form-control" name="promedio" id="promedio" value="{{$notas->promedio}}" readonly>
                                    </td>
                                    @if($curso->estado == 'Terminado')
                                        <td>
                                            <b>NOTAS CERRADAS</b><br>                                          
                                            @if($notas->promedio >= $curso->promedio_minimo)
                                                <a class="btn btn-primary" target="_blank" href="{{url('ver_certificado/'.$curso->id.'/'.$user->id)}}">Ver certificado</a>
                                               
                                            @else
                                                <b>Curso teminado.</b> <br> No aprobó el curso.
                                                <br><b>Promedio mínimo</b> para probar el curso era <b>{{ $curso->promedio_minimo }}</b>
                                            @endif
                                        </td>
                                       
                                    @else
                                        <td>
                                            <a class="actualizar btn btn-primary" data-curso="{{$alumno->id_curso}}" href="{{url('actualizar_notas/'.$notas->id)}}">Actualizar</a>
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
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {

                $(".actualizar").click(function(e){
                    e.preventDefault()
                    const _url = e.target.getAttribute('href')
                    const _curso = e.target.getAttribute('data-curso')
                    const
                        _nota1= e.target.parentNode.parentNode.children[2].firstElementChild.value,
                        _nota2= e.target.parentNode.parentNode.children[3].firstElementChild.value,
                        _nota3= e.target.parentNode.parentNode.children[4].firstElementChild.value,
                        _nota4= e.target.parentNode.parentNode.children[5].firstElementChild.value


                    console.log(_nota1)
                    console.log(_nota2)
                    console.log(_nota3)
                    console.log(_nota4)

                    const array = {}
                    array['nota1']=_nota1
                    array['nota2']=_nota2
                    array['nota3']=_nota3
                    array['nota4']=_nota4
                    array['promedio']=Math.round((parseInt(_nota1) + parseInt(_nota2) + parseInt(_nota3) + parseInt(_nota4)) / 4 )

                    if (window.confirm("¿Desea actualizar las notas del alumno?")) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: _url,
                            data: array,
                            type: 'patch',
                            dataType: "JSON",
                            beforeSend: function (response) {
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Enviando solicitud ...');
                            },
                            complete: function (response) {
                                console.log(response)
                                if (response.responseText == '') {
                                    $('.modal-body').html('Las notas se actualizaron con éxito.');
                                    window.location.replace(window.location.protocol + '//' + window.location.hostname + '/registrar_notas/'+_curso);
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

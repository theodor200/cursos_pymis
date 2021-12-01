@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="d-inline-block">Lista de docentes registrados. </h2>
                        <a href="{{url('/docentes/create')}}" class="btn btn-primary btn-lg float-right ml-2">Crear docente</a>
                        <a href="{{url('/excel_docentes')}}" class="btn btn-secondary btn-lg float-right">Exportar a excel</a>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Nombre(s) y apellidos</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">D.N.I</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Profesión</th>
                        <th scope="col">Grado de estudios</th>
                        <th scope="col">Centro de estudios</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($docentes as $docente)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            @php
                                $user = \App\User::find($docente->user_id);
                            @endphp
                            <td>{{strtoupper($user->name)}}</td>
                            <td>{{strtoupper($user->email)}}</td>
                            <td>{{strtoupper($docente->dni)}}</td>
                            <td>{{strtoupper($docente->fecha_nacimiento)}}</td>
                            <td>{{strtoupper($docente->celular)}}</td>
                            <td>{{strtoupper($docente->profesion)}}</td>
                            <td>{{strtoupper($docente->grado)}}</td>
                            <td>{{strtoupper($docente->centro_estudios)}}</td>
                            <td>{{strtoupper($docente->estado)}}</td>

                            <td>
                                <a class="d-block float-left mx-2" href="{{ url('docentes/'.$docente->id.'/edit')}}"><ion-icon size="large" name="create-outline"></ion-icon></a>
                                <a class="d-block float-left mx-2" href="{{ url('docentes/'.$docente->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                                <a class="delete d-block float-left mx-2" href="{{ url('docentes/'.$user->id)}}"><ion-icon size="large" name="trash-outline"></ion-icon></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

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
                    if (window.confirm("¿Desea borrar este docente?")) {
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
                                console.log(response)
                                if( response.responseText == ''){
                                    $('.modal-body').html('EL registro se eliminó con éxito.');
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/docentes');
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

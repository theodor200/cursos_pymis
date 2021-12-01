@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-inline-block">Lista de módulos del curso : {{strtoupper($curso->nombre)}} </h3>
                        @if($curso->estado == 'Terminado')
                            <h6 class="mt-4">NOTA: Este curso terminó, no podrá agregar más módulos.</h6>
                        @else
                            <a href="{{url('/modulo/create/'.$curso->id)}}" class="btn btn-primary btn-lg float-right">Crear módulo</a>
                        @endif
                        <h6 class="mt-4"><b>Nota:</b> Los módulos con estado "ACTIVO" podrán ser vistos por los alumnos, los que tiene estado "INACTIVO", no podrán ser vistos.</h6>

                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Estado del módulo</th>
                        <th scope="col">Nombres del módulo</th>
                        <th scope="col">Archivo del módulo</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Fecha de actualización</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modulos as $modulo)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{strtoupper($modulo->estado)}}</td>
                            <td>{{strtoupper($modulo->nombre)}}</td>
                            @if(empty($modulo->file))
                                <td>Este módulo no tiene archivos.</td>
                            @else
                                <td>{{strtoupper($modulo->file)}}
                                    <a class="badge badge-pill badge-dark" href="{{url('files/'.$modulo->file)}}" target="_blank"> VER ARCHIVO </a>
                                </td>
                            @endif
                            <td>{{strtoupper($modulo->created_at)}}</td>
                            <td>{{strtoupper($modulo->updated_at)}}</td>
                            <td>
                                @if($curso->estado == 'Terminado')
                                    <p>El curso termino.<br>Los módulos ya no se pueden editar.</p>
                                @else
                                    <a class="d-block float-left mx-2" href="{{ url('modulo/'.$modulo->id.'/edit')}}"><ion-icon size="large" name="create-outline"></ion-icon></a>
                                    <a class="delete d-block float-left mx-2" href="{{ url('modulo/'.$modulo->id.'/delete')}}"><ion-icon size="large" name="trash-outline"></ion-icon></a>
                                @endif

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
                    if (window.confirm("¿Desea borrar este módulo?")) {
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
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/modulo_lista/{{$curso->id}}');
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

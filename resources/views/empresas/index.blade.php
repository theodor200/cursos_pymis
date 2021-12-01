@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="d-inline-block">Lista de empresas registradas. </h2>
                        <a href="{{url('/empresas/create')}}" class="btn btn-primary btn-lg float-right ml-2">Crear empresa</a>
                        <a href="{{url('/excel_empresas')}}" class="btn btn-secondary btn-lg float-right">Exportar a excel</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Razón social</th>
                                <th scope="col">R.U.C</th>
                                <th scope="col">Rubro comercial</th>
                                <th scope="col">Correo electrónico</th>
                                <th scope="col">Contácto</th>
                                <th scope="col">Celular</th>
                                <th scope="col">N° de integrantes</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody style="font-size: 0.8rem">
                            @foreach($empresas as $empresa)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{strtoupper($empresa->razon_social)}}</td>
                                    <td>{{strtoupper($empresa->ruc)}}</td>
                                    <td>{{strtoupper($empresa->rubro)}}</td>
                                    <td>{{strtoupper($empresa->correo)}}</td>
                                    <td>{{strtoupper($empresa->contacto)}}</td>
                                    <td>{{strtoupper($empresa->celular)}}</td>
                                    <td>{{\App\Alumnos::where('id_empresa','=',$empresa->id)->count()}}</td>
                                    <td>{{strtoupper($empresa->estado)}}</td>
                                    <td>
                                        <a class="d-block float-left mx-2" href="{{ url('empresas/'.$empresa->id.'/edit')}}"><ion-icon size="large" name="create-outline" style="width: 25px"></ion-icon></a>
                                        <a class="d-block float-left mx-2" href="{{ url('empresas/'.$empresa->id)}}"><ion-icon size="large" name="eye-outline" style="width: 25px"></ion-icon></a>
                                        <a class="delete d-block float-left mx-2 delete" href="{{ url('empresas/'.$empresa->id)}}"><ion-icon size="large" name="trash-outline" style="width: 25px"></ion-icon></a>

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
                    if (window.confirm("¿Desea borrar esta empresa?")) {
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
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/empresas');
                                }else{
                                    $('.modal-body').html(response.responseJSON.mensaje);
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr);
                            }
                        });
                    }
                });
            }, false);
        })();
    </script>
@endsection

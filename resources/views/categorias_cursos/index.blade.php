@extends('layouts.app-access')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-inline-block">Lista de las categorías de cursos registrados. </h3>
                        <a href="{{url('/categorias_cursos/create')}}" class="btn btn-primary btn-lg float-right ml-2">Crear categoría de curso</a>
                        <a href="{{url('/excel_categorias_cursos')}}" class="btn btn-secondary btn-lg float-right">Exportar a excel</a>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">N° de cursos asignados</th>
                        <th scope="col">Acciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($catcursos as $catCurso)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{strtoupper($catCurso->nombre)}}</td>

                            <td>{{ \Illuminate\Support\Facades\DB::table('cursos')->where('id_categoria','=',$catCurso->id)->count() }}</td>

                            <td>
                                <a class="d-block float-left mx-2" href="{{ url('categorias_cursos/'.$catCurso->id.'/edit')}}"><ion-icon size="large" name="create-outline"></ion-icon></a>
                                <a class="d-block float-left mx-2" href="{{ url('categorias_cursos/'.$catCurso->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                                <a class="delete d-block float-left mx-2" href="{{ url('categorias_cursos/'.$catCurso->id)}}"><ion-icon size="large" name="trash-outline"></ion-icon></a>
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
                    if (window.confirm("¿Desea borrar esta categoría de curso?")) {
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
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/categorias_cursos');
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

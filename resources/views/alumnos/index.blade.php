@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="d-inline-block">Lista de alumnos registrados. </h2>
                        <a href="{{url('/excel_alumnos')}}" class="btn btn-secondary btn-lg float-right">Exportar a excel</a>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Nombre(s) y apellidos</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">D.N.I</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($alumnos as $alumno)
                        @php
                            $user = \App\User::find($alumno->user_id);
                            
                            if($alumno->id_empresa == 0){
                                $empresa = '';                               
                            }else{
                                $nombre_empresa = \App\Empresas::find($alumno->id_empresa);                            
                                $empresa = $nombre_empresa->razon_social;
                            } 
                        @endphp
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$empresa}}</td>
                            <td>{{strtoupper($user->name)}}</td>
                            <td>{{strtoupper($user->email)}}</td>
                            <td>{{strtoupper($alumno->dni)}}</td>
                            <td>{{strtoupper($alumno->direccion)}}</td>
                            <td>{{strtoupper($alumno->fecha_nacimiento)}}</td>
                            <td>{{strtoupper($alumno->celular)}}</td>
                            <td>{{strtoupper($alumno->cargo)}}</td>
                            <td><a class="delete d-block float-left mx-2" href="{{ url('alumno/'.$user->id.'/delete')}}"><ion-icon size="large" name="trash-outline"></ion-icon></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><b>¿Desea eliminar este alumno?</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mt-2"> Se eliminará la siguiente información del alumno:</p>
                        <ul>
                            <li>Inscripcion de sus cursos.</li>
                            <li>Notas de los cursos.</li>
                            <li>Perfil del alumno.</li>
                            <li>Credenciales de acceso al sistema.</li>
                        </ul>
                    <div class="text-danger"><ion-icon size="large" class="align-middle" name="alert-circle"></ion-icon><span> No se podrá recuperar estos datos una vez eliminados.</span></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_eliminar" class="btn btn-primary">Sí, eliminar</button>
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
                    e.stopPropagation()

                    $("#modal_delete").modal('show');

                    $("#btn_eliminar").on('click',(event)=>{
                        $("#modal_delete").modal('hide');
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
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/alumnos');
                                }else{
                                    $('.modal-body').html(response.responseJSON.mensaje);
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    })

                });
            }, false);
        })();
    </script>
@endsection

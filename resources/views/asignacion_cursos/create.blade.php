@extends('layouts.app-access')
@section('content')
    @inject('GetCategoria','App\Services\GetCategoriaCurso')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1 class="text-uppercase">Registrar asignación de curso</h1>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2">Rellene el formulario para asignar cursos a un docente.<br>
                Solo podrá asignar un curso si su estado es activo, si el estado es inactivo o terminado no podrá ser asignado.<br>
            Solo podrá asignar docentes con estado activo.</p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/asignacion_cursos_docente')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                {{csrf_field()}}

                <h5 class=" text-uppercase ">Información del curso:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Categoría del curso:</label>
                        <select class="form-control" name="id_categoria" id="id_categoria" required>
                            <option value="">Seleccione una categoría</option>
                            @php

                                $categoria_cursos = \Illuminate\Support\Facades\DB::table('categorias_cursos')->get();
                            @endphp

                            @foreach($categoria_cursos as $categoria_curso)
                                <option value="{{$categoria_curso->id}}">{{strtoupper($categoria_curso->nombre)}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Seleccione una categoría</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Curso:</label>
                        <select class="form-control" name="id_curso" id="id_curso" required>
                            <option value="">Seleccione un curso</option>
                        </select>
                        <div class="invalid-feedback">Seleccione un curso</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>

                </div>

                <hr class="my-4">
                <h5 class=" text-uppercase ">Información del docente:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Docente:</label>
                        <select class="form-control" name="id_docente" id="id_docente" required>
                            <option value="">Seleccione un docente</option>
                            @php
                                $user_docente = \App\User::all()->where('role','=','docente');
                                foreach ($user_docente as $docente){
                                    $perfil = App\PerfilDocente::where('user_id','=',$docente->id)->first();

                                    if($perfil->estado == 'Activo'){
                                        echo '<option value="'.$docente->id.'">'.strtoupper($docente->name).'</option>';
                                    }
                                }
                            @endphp

                        </select>
                        <div class="invalid-feedback">Seleccione un docente</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>
                <button class="btn btn-secondary my-5" type="submit" id="crear_rango">Registrar asignación de curso</button>

            </form>
        </div>
    </div>
    <hr>
</div>
@endsection
@section('javascript-optional')
<script>
    (function() {

        const nom = "  hola   como estas    "
        console.log(nom.replace(/ /g, ""));
        'use strict';
        const url = location.protocol+'//'+location.hostname+'/'
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.lastElementChild.addEventListener('click',function(e){
                    form.classList.add('was-validated');
                    e.preventDefault();
                    //e.stopPropagation();
                    if (form.checkValidity() === true) {

                        $.ajax({
                            url: "{{url('/asignacion_cursos')}}",
                            type: "POST",
                            data: $(form).serialize(),
                            dataType: 'json',
                            cache: false,
                            processData:false,
                            beforeSend: function(response){
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Enviando datos ...');
                            },
                            success: function(response){
                            },
                            complete:function(response){
                                console.log(response)
                                if( response.responseText == ''){
                                    $('.modal-body').html('EL registro se guardó con éxito.');
                                    form.classList.remove('was-validated');
                                    form.classList.add('needs-validation');
                                    form.reset();
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/asignacion_cursos');
                                }else{
                                    let mensaje=response.responseJSON.mensaje
                                    typeof mensaje=== 'undefined' ? mensaje=' ' : mensaje = mensaje + '<br>'
                                    $('.modal-body').html(
                                        mensaje
                                    );
                                }
                            }
                        });
                    }
                })
            });

            $("#id_categoria").on('change',(e)=>{
                const id = e.target.value
                $.get(url+'cursos/'+id+'/get',(e)=>{
                    console.log(e)
                    $("#id_curso").empty();
                    $("#id_curso").append("<option value=''>Seleccione un curso</option>")
                    $.each(e, (index, value)=>{
                        $("#id_curso").append("<option value='"+value.id+"'>"+value.nombre.toUpperCase()+"</option>")
                    })
                })
            })
        }, false);
    })();
</script>
@endsection

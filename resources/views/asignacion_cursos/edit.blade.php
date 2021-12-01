@extends('layouts.app-access')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1 class="text-uppercase">Actualización de asignación de curso</h1>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2">Actualice los datos del formulario.<br>
                Solo podrá asignar un curso si su estado es activo, si el estado es inactivo o terminado no podrá ser asignado.<br>
                Solo podrá asignar docentes con estado activo.</p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/asignacion_cursos_docente/'.$asignacion_curso->id.'/edit')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                {{csrf_field()}}
                {{method_field('PATCH')}}

                <h5 class=" text-uppercase ">Información del curso:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Categoría de curso:</label>
                        <select class="form-control" name="id_categoria" id="id_categoria" required>
                            @php
                                $categoria_curso_actual =  \Illuminate\Support\Facades\DB::table('categorias_cursos')->where('id','=',$asignacion_curso->id_categoria)->first();
                                $categoria_cursos = \Illuminate\Support\Facades\DB::table('categorias_cursos')->whereNotIn('id',[$asignacion_curso->id_categoria])->get();
                            @endphp
                            <option value="{{$categoria_curso_actual->id}}">{{strtoupper($categoria_curso_actual->nombre)}}</option>
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
                            @php
                                $curso_actual =  \Illuminate\Support\Facades\DB::table('cursos')->where('id','=',$asignacion_curso->id_curso)->first();
                                $cursos = \Illuminate\Support\Facades\DB::table('cursos')->whereNotIn('id',[$asignacion_curso->id_curso])
                                ->where('estado','=','Activo')->get();
                            @endphp
                            <option value="{{$curso_actual->id}}">{{strtoupper($curso_actual->nombre)}}</option>
                            @foreach($cursos as $curso)
                                <option value="{{$curso->id}}">{{strtoupper($curso->nombre)}}</option>
                            @endforeach
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
                            @php
                                $docente_actual =  \Illuminate\Support\Facades\DB::table('users')->where([['id','=',$asignacion_curso->id_docente],['role','=','docente']])->first();
                                $perfil_docentes_activos = \Illuminate\Support\Facades\DB::table('perfil_docentes')->whereNotIn('user_id',[$asignacion_curso->id_docente])->where('estado','=','Activo')->get();
                            @endphp
                            <option value="{{$docente_actual->id}}">{{strtoupper($docente_actual->name)}}</option>
                            @foreach($perfil_docentes_activos as $perfil_docente)
                                @php
                                    $user_docente = \Illuminate\Support\Facades\DB::table('users')->where([['id','=',$perfil_docente->user_id],['role','=','docente']])->first();
                                @endphp
                                <option value="{{$user_docente->id}}">{{strtoupper($user_docente->name)}}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback">Seleccione un docente</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>
                <button class="btn btn-secondary my-5" type="submit" id="crear_rango">Actualizar asignación de curso</button>

            </form>
        </div>
    </div>
    <hr>
</div>
@endsection
@section('javascript-optional')
<script>
    (function() {
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
                        const patch = document.getElementsByName('_method')[0].value
                        $.ajax({
                            url: "{{url('/asignacion_cursos/'.$asignacion_curso->id)}}",
                            type: patch,
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
                                    $('.modal-body').html('EL actualizo se guardo con éxito.');
                                    form.classList.remove('was-validated');
                                    form.classList.add('needs-validation');
                                    form.reset();
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/asignacion_cursos/' + {{$asignacion_curso->id}} + '/edit');
                                }else{
                                    $('.modal-body').html( 'No se pudo actualizar el registro' );
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

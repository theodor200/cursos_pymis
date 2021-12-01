@extends('layouts.app-access')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1>Actualizar módulo para el curso: {{strtoupper($curso->nombre)}}</h1>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2"><b>Nota: Si desea actualizar el archivo del módulo, suba un nuevo archivo.</b></p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/modulo')}}" method="post" enctype="multipart/form-data" class="needs-validation" id="form" novalidate>
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <input type="hidden" value="{{$curso->id}}" id="_id" name="_id" readonly>
                <h5 class=" text-uppercase ">Información del módulo:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();"
                               value="{{strtoupper($modulo->nombre)}} " required >
                        <div class="invalid-feedback"> Ingrese un nombre.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Estado del módulo</label>
                        <select class="form-control" id="estado" name="estado" required>

                            @if($modulo->estado == 'Activo')
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>

                            @elseif($modulo->estado == 'Inactivo')
                                <option value="Inactivo">Inactivo</option>
                                <option value="Activo">Activo</option>
                            @endif

                        </select>
                        <div class="invalid-feedback"> Seleccione un estado.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="col-md-8 mt-3">
                        <h5>ARCHIVO ACTUAL: <a class="badge badge-pill badge-dark" href="{{url('files/'.$modulo->file)}}" target="_blank"> VER ARCHIVO </a></h5>
                        <h6>NOMBRE: {{$modulo->file}}</h6>
                    </div>
                </div>
                <hr>
                <div class="form-row">

                    <div class="col-md-12 mt-4">
                        <h5 for="validationCustom02">¿DESEA ACTUALIZAR EL ARCHIVO DEL MÓDULO?</h5>
                        <p>Suba un nuevo archivo para reemplazar el actual, puede subir archivos pdf, word, excel, power point, imágenes</p>
                    </div>
                    <div class="col-md-8 custom-file">
                        <input class="form-control" type="file" id="file" name="file">
                        <div class="valid-feedback">Este campo no es requerido.</div>
                    </div>
                </div>
                <button class="btn btn-secondary my-5" type="submit" id="crear_rango">Actualizar módulo</button>
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
                    e.stopPropagation();
                    if (form.checkValidity() === true) {
                        const patch = document.getElementsByName('_method')[0].value
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{url('/modulo/'.$modulo->id.'/update')}}",
                            type: 'POST',
                            data:  new FormData(form),
                            contentType:false,
                            cache: false,
                            processData:false,
                            beforeSend: function(response){
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Enviando datos ...');
                            },
                            success: function(response){
                            },
                            complete:function(response){
                                if( response.responseText == ''){
                                    $('.modal-body').html('EL registro se actualizó con éxito.');
                                    form.classList.remove('was-validated');
                                    form.classList.add('needs-validation');
                                    form.reset();
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/modulo/{{$modulo->id}}/edit');
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

        }, false);
    })();

</script>
@endsection

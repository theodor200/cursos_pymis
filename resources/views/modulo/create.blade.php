@extends('layouts.app-access')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h2>Registrar módulo para el curso: {{strtoupper($curso->nombre)}}</h2>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2">Rellene el formulario para registrar un módulo.</p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/modulo')}}" method="post" enctype="multipart/form-data" class="needs-validation" id="form" novalidate>
                {{csrf_field()}}
                <input type="hidden" value="{{$curso->id}}" id="_id" name="_id" readonly>
                <h5 class=" text-uppercase ">Información del módulo:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Nombre del módulo:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                        <div class="invalid-feedback"> Ingrese un nombre.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Estado del módulo</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="">Seleccionar</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        <div class="invalid-feedback"> Seleccione un estado.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-8 mt-3">
                        <label for="validationCustom02">Subir un archivo al módulo:</label><br>
                        <p>Puede subir archivos de tipo pdf, word, excel, power point, imágenes</p>
                    </div>
                    <div class="col-md-8 custom-file">
                        <input class="form-control" type="file" id="file" name="file" required>
                        <div class="invalid-feedback">Seleccione un archivo a subir.</div>
                    </div>
                </div>
                <button class="btn btn-secondary my-5" type="submit" id="crear_rango">Registrar módulo</button>
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

                        $.ajax({
                            url: "{{url('/modulo')}}",
                            type: "POST",
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
                                console.log(response)
                                if( response.responseText == ''){
                                    $('.modal-body').html('EL registro se guardó con éxito.');
                                    form.classList.remove('was-validated');
                                    form.classList.add('needs-validation');
                                    form.reset();
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/modulo_lista/{{$curso->id}}');
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

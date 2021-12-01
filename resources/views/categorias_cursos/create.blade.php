@extends('layouts.app-access')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1 class="text-uppercase">Registro categoría de curso</h1>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2">Rellene el formulario para registrar una categoría de curso, después podrá asignar a esta categoría los cursos que cree a futuro.
            </p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/categorias_cursos')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                {{csrf_field()}}

                <h5 class=" text-uppercase ">Ingrese los datos:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                        <div class="invalid-feedback"> Ingrese un nombre valido.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>

                <button class="btn btn-secondary my-5" type="submit" id="crear_docente">Registrar categoría</button>
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
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.lastElementChild.addEventListener('click',function(e){
                    form.classList.add('was-validated');
                    e.preventDefault();
                    e.stopPropagation();
                    if (form.checkValidity() === true) {
                        $.ajax({
                            url: "{{url('/categorias_cursos')}}",
                            type: "POST",
                            data: $(form).serialize(),
                            dataType: 'json',
                            cache: false,
                            processData:false,
                            beforeSend: function(response){
                                $('#myModalMessage').modal('show');
                                $('.modal-body').html('Enviando datos ...');
                                console.log(response)
                            },
                            success: function(response){

                            },
                            complete:function(response){

                                if( response.responseText == ''){
                                    $('.modal-body').html('EL registro se guardó con éxito.');
                                    form.classList.remove('was-validated');
                                    form.classList.add('needs-validation');
                                    form.reset();
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/categorias_cursos');

                                }else{
                                    let nombre= response.responseJSON.errors.nombre

                                    typeof nombre === 'undefined' ? nombre=' ' : nombre = nombre

                                    $('.modal-body').html(
                                        nombre
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

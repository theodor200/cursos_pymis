@extends('layouts.app-access')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1 class="text-uppercase">Registro de docente</h1>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2">Rellene el formulario para registrar un docente.</p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/docentes')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                {{csrf_field()}}
                <h5 class=" text-uppercase ">Información de inicio de sesión:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Correo electrónico:</label>
                        <input type="text" class="form-control" id="email" name="email"
                               style="text-transform: uppercase" onkeyup="this.value.toUpperCase();"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required >
                        <div class="invalid-feedback"> Ingrese un correo electrónico valido.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required >
                        <div class="invalid-feedback"> Ingrese una contraseña.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Información general:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Nombre(s):</label>
                        <input type="text" class="form-control" id="nombres" name="nombres"
                               style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                        <div class="invalid-feedback"> Ingrese un nombre valido.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos"  name="apellidos"
                               style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
                        <div class="invalid-feedback"> Ingrese sus apellidos.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>D.N.I:</label>
                        <input type="text" class="form-control" id="dni"  name="dni"
                               style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                        <div class="invalid-feedback"> Ingrese un DNI valido.</div>
                        <div class="valid-feedback">Este campo no es obligatorio.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Fecha de nacimiento:</label>
                        <input type="text" class="form-control" id="fecha_nacimiento"  name="fecha_nacimiento" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                        <div class="invalid-feedback"> Ingrese una fecha de nacimiento valida.</div>
                        <div class="valid-feedback">Este campo no es obligatorio.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Celular:</label>
                        <input type="text" class="form-control" id="celular"  name="celular" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                        <div class="invalid-feedback"> Ingrese un celular valido.</div>
                        <div class="valid-feedback">Este campo no es obligatorio.</div>
                    </div>

                </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Estudio y grado:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Centro de estudios:</label>
                        <input type="text" class="form-control" id="centro_estudios"  name="centro_estudios" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                        <div class="invalid-feedback"> Ingrese un centro estudios valido.</div>
                        <div class="valid-feedback">Este campo no es obligatorio.</div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Grado de estudios:</label>
                        <select class="form-control" id="grado" name="grado" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" >
                            <option value="">Seleccionar</option>
                            <option value="Practicante">Practicante</option>
                            <option value="Bahiller">Bachiller</option>
                            <option value="Titulado">Titulado</option>
                            <option value="Maestria">Maestría</option>
                            <option value="Doctorado">Doctorado</option>
                        </select>
                        <div class="invalid-feedback"> Seleccione un grado de estudio.</div>
                        <div class="valid-feedback">Este campo no es obligatorio.</div>
                    </div>

                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Profesión:</label>
                        <input type="text" class="form-control" id="profesion"  name="profesion" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                        <div class="invalid-feedback"> Ingrese su profesión</div>
                        <div class="valid-feedback">Este campo no es obligatorio.</div>
                    </div>
                </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Estado del docente:</h5>
                <p class="font-weight-normal mt-4 mb-2">Si el docente esta activo podrá asignarle cursos a dictar, caso contrario estará inhabilitado para realizar cualquier función en el sistema.</p>
                <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom02"><br>Estado del docente</label>
                            <select class="form-control" id="estado" name="estado" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                                <option value="">Seleccionar</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                            <div class="invalid-feedback"> Seleccione un estado.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                </div>
                <button class="btn btn-secondary my-5" type="submit" id="crear_docente">Registrar docente</button>
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
                            url: "{{url('/docentes')}}",
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
                                    window.location.replace(window.location.protocol+'//'+window.location.hostname+'/docentes');
                                }else{
                                    let nombres = response.responseJSON.errors.nombres,
                                        apellidos = response.responseJSON.errors.apellidos,
                                        estado = response.responseJSON.errors.estado,
                                        email = response.responseJSON.errors.email,
                                        password = response.responseJSON.errors.password

                                    typeof nombres === 'undefined' ? nombres=' ' : nombres = nombres + '<br>'
                                    typeof apellidos === 'undefined' ? apellidos=' ' : apellidos = apellidos + '<br>'
                                    typeof estado === 'undefined' ? estado=' ' : estado = estado + '<br>'
                                    typeof email === 'undefined' ? email=' ' : email = email + '<br>'
                                    typeof password === 'undefined' ? password=' ' : password = password + '<br>'

                                    $('.modal-body').html(
                                        nombres + apellidos +  estado + email + password
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

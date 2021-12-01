@extends('layouts.app-access')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1 class="text-uppercase"> Mi perfil</h1>
                <hr class="my-4">
                <p class="font-weight-normal mt-2 mb-2">Actualiza tu perfil.<br>
                    <br><b>A tener en consideración:</b><br>
                </p>
                <ul>
                    <li>El campo correo electrónico no se podrá actualizar, este campo es vital para acceder al sistema y enviarte notificaciones.</li>
                    <li>Para cambiar la contraseña actual ingrese un texto en el campo contraseña, caso contrario deje el campo en blanco.</li>
                    <li>Se enviará a tu correo electrónico <b>{{$user->email}}</b> las actualizaciones que se realicen en este formulario.</li>
                </ul>

            </div>
        </div>
        <hr class="my-4">
        <div class="row mt-0">
            <div class="col">
                <form action="{{url('/docentes/'.$docente->id)}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <input type="hidden" name="_id" value="{{$docente->id}}">
                    <h5 class=" text-uppercase ">Información de inicio de sesión:</h5>

                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom02"><br>Correo electrónico:<br><b> Este campo no se actualiza.</b></label>
                            <input type="text" class="form-control" id="email_update" name="email_update"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                                   value="{{$user->email}}" readonly required >
                            <div class="invalid-feedback"> Ingrese un correo electrónico valido.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom02" class="mt-4"><br>Contraseña:</label>
                            <input type="password" class="form-control" id="password_update" name="password_update">
                            <div class="invalid-feedback"> Ingrese una contraseña.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class=" text-uppercase ">Información general:</h5>
                    <div class="form-row">
                        <div class="col-md-8 mb-1">
                            <label for="validationCustom02"><br>Nombre(s) y apellidos:</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" value="{{$user->name}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                            <div class="invalid-feedback"> Ingrese su nombre(s) y apellidos.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>

                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>D.N.I:</label>
                            <input type="text" class="form-control" id="dni"  name="dni" value="{{$docente->dni}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                            <div class="invalid-feedback"> Ingrese su DNI.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Fecha de nacimiento:</label>
                            <input type="text" class="form-control" id="fecha_nacimiento"  value="{{$docente->fecha_nacimiento}}" name="fecha_nacimiento">
                            <div class="invalid-feedback"> Ingrese su fecha de nacimiento.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Celular:</label>
                            <input type="text" class="form-control" id="celular"  name="celular" value="{{$docente->celular}}">
                            <div class="invalid-feedback"> Ingrese su número de celular.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>

                    </div>
                    <hr class="my-4">
                    <h5 class=" text-uppercase ">Estudio y grado:</h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Centro de estudios:</label>
                            <input type="text" class="form-control" id="centro_estudios"  name="centro_estudios" value="{{$docente->centro_estudios}}"
                             style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" >
                            <div class="invalid-feedback"> Ingrese su centro de estudios</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>

                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Grado de estudios:</label>
                            <select class="form-control" id="grado" name="grado" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" >
                                <option value="{{$docente->grado}}">{{$docente->grado}}</option>
                                <option value="Practicante">Practicante</option>
                                <option value="Bahiller">Bachiller</option>
                                <option value="Titulado">Titulado</option>
                                <option value="Maestria">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                            </select>
                            <div class="invalid-feedback"> Seleccione un grado de estudios.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>

                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Profesión:</label>
                            <input type="text" class="form-control" id="profesion"  name="profesion" value="{{$docente->profesion}}"
                                    style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                            <div class="invalid-feedback"> Ingrese su profesión.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class=" text-uppercase ">Estado del docente:</h5>
                    @if($docente->estado == 'Activo')
                        <p class="font-weight-normal mt-4 mb-2"> Su estado es <b>ACTIVO</b> por lo tanto puede acceder al sistema</p>
                    @elseif($docente->estado == 'Inactivo')
                        <p class="font-weight-normal mt-4 mb-2"> Su estado es <b>INACTIVO</b> por lo tanto NO puede acceder al sistema</p>
                    @endif

                    <button class="btn btn-secondary my-5" type="submit" id="crear_docente">Actualizar mi perfil de docente</button>
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
                            const patch = document.getElementsByName('_method')[0].value
                            const _id = document.getElementsByName('_id')[0].value
                            $.ajax({
                                url: "{{url('/perfil_docente')}}/"+_id,
                                type: patch,
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
                                        $('.modal-body').html('EL registro se actualizo con éxito.');
                                        form.classList.remove('was-validated');
                                        form.classList.add('needs-validation');
                                        form.reset();
                                        window.location.replace(window.location.protocol+'//'+window.location.hostname+'/perfil_docente/'+_id+'/edit');
                                    }else{
                                        let nombres = response.responseJSON.errors.nombres,
                                            dni = response.responseJSON.errors.dni,
                                            profesion = response.responseJSON.errors.profesion,
                                            grado = response.responseJSON.errors.grado,
                                            estado = response.responseJSON.errors.estado,
                                            email_update = response.responseJSON.errors.email_update,
                                            password_update = response.responseJSON.errors.password_update

                                        typeof nombres === 'undefined' ? nombres=' ' : nombres = nombres + '<br>'
                                        typeof dni === 'undefined' ? dni=' ' : dni = dni + '<br>'
                                        typeof profesion === 'undefined' ? profesion=' ' : profesion = profesion + '<br>'
                                        typeof grado === 'undefined' ? grado=' ' : grado = grado + '<br>'
                                        typeof estado === 'undefined' ? estado=' ' : estado = estado + '<br>'
                                        typeof email_update === 'undefined' ? email_update=' ' : email_update = email_update + '<br>'
                                        typeof password_update === 'undefined' ? password_update=' ' : password_update = password_update + '<br>'


                                        $('.modal-body').html(
                                            nombres + dni + profesion + grado + estado+email_update+password_update
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

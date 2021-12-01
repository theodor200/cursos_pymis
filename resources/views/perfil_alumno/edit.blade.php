@extends('layouts.app-access')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1 class="text-uppercase"> Mi perfil</h1>
                <hr class="my-4">
                <p class="font-weight-normal mt-2 mb-2">Actualizar mi perfil.<br>
                    <br><b>A tener en consideración:</b><br>
                </p>
                <ul>
                    <li>El campo correo electrónico no se podrá actualizar, este campo es vital acceder al sistema y enviarte de notificaciones.</li>
                    <li>Para cambiar la contraseña actual ingrese un texto en el campo contraseña, caso contrario deje el campo en blanco.</li>
                    <li>Se enviará a tu correo electrónico <b>{{$user->email}}</b> las actualizaciones que se realicen en este formulario.</li>
                </ul>

            </div>
        </div>
        <hr class="my-4">
        <div class="row mt-0">
            <div class="col">
                <form action="{{url('/perfil_alumnos/'.$alumno->id)}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <input type="hidden" name="_id" value="{{$alumno->id}}">
                    <h5 class=" text-uppercase ">Información de inicio de sesión:</h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom02"><br>Correo: <br><b>Este campo no se actualiza</b></label>
                            <input type="text" class="form-control" id="email_update" name="email_update"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                                   value="{{$user->email}}" readonly required >
                            <div class="invalid-feedback"> Ingrese un correo valido.</div>
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
                    <h5 class=" text-uppercase ">Información laboral:</h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Empresa: </label>
                            <select class="form-control" name="id_empresa" id="id_empresa" required>
                                @php
                                    $list_empresas = App\Empresas::all()->where('estado','=','activo');
                                        if($alumno->id_empresa == 0){
                                            echo '<option value="">Seleccione una empresa</option>';
                                            foreach ($list_empresas as $empresa){
                                                echo '<option value="'.$empresa->id.'">'.strtoupper($empresa->razon_social).'</option>';
                                            }
                                        }else{
                                            $actual_empresa = App\Empresas::where('id_empresa','=',$alumno->id_empresa)->where('estado','=','activo');
                                            foreach ($actual_empresa as $actual){
                                                echo '<option value="'.$actual->id.'">'.strtoupper($actual->razon_social).'</option>';
                                            }
                                            foreach ($list_empresas as $empresa){
                                                echo '<option value="'.$empresa->id.'">'.strtoupper($empresa->razon_social).'</option>';
                                            }
                                        }
                                @endphp
                            </select>
                            <div class="invalid-feedback">Seleccione una empresa.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-8 mb-1">
                        <label for="validationCustom02"><br>Cargo laboral:</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" value="{{$alumno->cargo}}"
                               style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                        <div class="invalid-feedback"> Ingrese un cargo laboral.</div>
                        <div class="valid-feedback">Este campo no es obligatorio.</div>
                    </div>
                    </div>

                    <hr class="my-4">
                    <h5 class=" text-uppercase ">Información personal:</h5>
                    <div class="form-row">
                        <div class="col-md-8 mb-1">
                            <label for="validationCustom02"><br>Nombre(s) y apellidos:</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" value="{{$user->name}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                            <div class="invalid-feedback"> Ingrese su nombre(s) y apellidos.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>D.N.I:</label>
                            <input type="text" class="form-control" id="dni"  name="dni" value="{{$alumno->dni}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
                            <div class="invalid-feedback"> Ingrese su DNI.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Fecha de nacimiento:</label>
                            <input type="text" class="form-control" id="fecha_nacimiento"  value="{{$alumno->fecha_nacimiento}}" name="fecha_nacimiento">
                            <div class="invalid-feedback"> Ingrese su fecha de nacimiento.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Celular:</label>
                            <input type="text" class="form-control" id="celular"  name="celular" value="{{$alumno->celular}}">
                            <div class="invalid-feedback"> Ingrese su número de celular.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="validationCustom01"><br>Dirección:</label>
                            <input type="text" class="form-control" id="direccion"  name="direccion" value="{{$alumno->direccion}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                            <div class="invalid-feedback"> Ingrese su dirección.</div>
                            <div class="valid-feedback">Este campo no es obligatorio.</div>
                        </div>
                    </div>


                    <button class="btn btn-secondary my-5" type="submit" id="crear_docente">Actualizar mi perfil de alumno</button>
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
                                url: "{{url('/perfil_alumno')}}/"+_id,
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
                                        window.location.replace(window.location.protocol+'//'+window.location.hostname+'/perfil_alumno/'+_id+'/edit');
                                    }else{
                                        let nombres = response.responseJSON.errors.nombres,
                                            email_update = response.responseJSON.errors.email_update,
                                            password_update = response.responseJSON.errors.password_update

                                        typeof nombres === 'undefined' ? nombres=' ' : nombres = nombres + '<br>'
                                        typeof email_update === 'undefined' ? email_update=' ' : email_update = email_update + '<br>'
                                        typeof password_update === 'undefined' ? password_update=' ' : password_update = password_update + '<br>'


                                        $('.modal-body').html(
                                            nombres + email_update + password_update
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

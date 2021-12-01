@extends('layouts.app-access')
@section('content')
    @inject('GetDepartamento','App\Services\GetUbicacion')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1 class="text-uppercase">Registro de empresa</h1>
            <hr class="my-4">
            <p class="font-weight-normal mt-2 mb-2">Rellene el formulario para registrar una empresa, y los alumnos inscritos podrán seleccionar la empresa donde laboran.</p>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-0">
        <div class="col">
            <form action="{{url('/empresas')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                {{csrf_field()}}
                {{ method_field('POST')}}

                <h5 class=" text-uppercase ">Información general:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom02"><br>Razón social:</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                        <div class="invalid-feedback"> Ingrese una razón social.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>R.U.C:</label>
                        <input type="text" class="form-control" id="ruc"  name="ruc" pattern="[0-9]*">
                        <div class="invalid-feedback"> Ingrese un R.U.C. valido</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Rubro comercial:</label>
                        <input type="text" class="form-control" id="rubro"  name="rubro" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                        <div class="invalid-feedback"> Ingrese un rubro comercial.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Dominio de la empresa:</h5>
                    <div class="form-row">
                        <div class="col-md-6 mb-1">
                            <label for="validationCustom01"><br>Dominio:</label>
                            <input type="text" class="form-control" id="dominio" name="dominio" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" placeholder="Ejemplo: miempresa.com"
                                       required>
                            <div class="invalid-feedback"> Ingrese un dominio.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                    </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Contácto y ubicación:</h5>
                <div class="form-row">
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Nombre del contácto:</label>
                        <input type="text" class="form-control" id="contacto"  name="contacto" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
                        <div class="invalid-feedback"> Ingrese un nombre</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Celular:</label>
                        <input type="text" class="form-control" id="celular"  name="celular" pattern="[0-9_-]*">
                        <div class="invalid-feedback"> Ingrese un celular valido (número y guiones permitidos)</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Correo electrónico :</label>
                        <input type="text" class="form-control" id="correo"  name="correo" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();"
                               pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
                        <div class="invalid-feedback"> Ingrese un correo electrónico valido></div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Departamento:</label>
                        <select class="form-control" name="id_departamento" id="departamento" required>
                            @foreach($GetDepartamento->getDepartamento() as $index=>$deparmanto)
                                <option value="{{ $index }}">{{ $deparmanto }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Seleccione un departamento</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Provincia:</label>
                        <select class="form-control" name="id_provincia" id="provincia" required>
                            <option value="">Seleccione una provincia</option>
                        </select>
                        <div class="invalid-feedback">Seleccione una provincia</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="validationCustom01"><br>Distrito:</label>
                        <select class="form-control" name="id_distrito" id="distrito" required>
                            <option value="">Seleccione un distrito</option>
                        </select>
                        <div class="invalid-feedback">Seleccione un distrito</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label for="validationCustom01"><br>Dirección:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
                        <div class="invalid-feedback"> Ingrese una dirección.</div>
                        <div class="valid-feedback">Correcto.</div>
                    </div>
                </div>
                <hr class="my-4">
                <h5 class=" text-uppercase ">Estado de la empresa:</h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Estado:</label>
                            <select class="form-control" name="estado" id="estado" required>
                                <option>Seleccione un estado</option>
                                <option value="activo">ACTIVO</option>
                                <option value="inactivo">INACTIVO</option>
                            </select>
                            <div class="invalid-feedback">Seleccione un estado</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                    </div>
                <button class="btn btn-secondary my-5" type="submit" id="crear_rango">Registrar empresa</button>
            </form>
        </div>
    </div>
    <hr>
</div>
@endsection
@section('javascript-optional')
<script src="{{ asset('js/empresa.js') }}"></script>
@endsection

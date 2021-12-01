@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1 class="text-uppercase">Actualizar empresa</h1>
                <hr class="my-4">
                <p class="font-weight-normal mt-2 mb-2">Actualice los datos de la empresa registrada.</p>
            </div>
        </div>
        <hr class="my-4">
        <div class="row mt-0">
            <div class="col">
                <form action="{{url('/empresas/'.$empresa->id)}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="_id" value="{{$empresa->id}}">
                    <h5 class=" text-uppercase ">Información general:</h5>
                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom02"><br>Razón social:</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{$empresa->razon_social}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required >
                            <div class="invalid-feedback"> Ingrese una razón social.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>R.U.C:</label>
                            <input type="text" class="form-control" id="ruc"  name="ruc" pattern="[0-9]*" value="{{$empresa->ruc}}">
                            <div class="invalid-feedback"> Ingrese un R.U.C. valido</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Rubro comercial:</label>
                            <input type="text" class="form-control" id="rubro"  name="rubro" value="{{$empresa->rubro}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();">
                            <div class="invalid-feedback"> Ingrese un rubro comercial.</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class=" text-uppercase ">Dominio de la empresa:</h5>
                    <div class="form-row">
                        <div class="col-md-6 mb-1">
                            <label for="validationCustom01"><br>Dominio: Este campo no se actualiza</label>
                            <input type="text" class="form-control" id="dominio" name="dominio" value="{{$empresa->dominio}}" readonly
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" placeholder="Ejemplo: miempresa.com"
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
                            <input type="text" class="form-control" id="contacto"  name="contacto" value="{{$empresa->contacto}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
                            <div class="invalid-feedback"> Ingrese un nombre</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Celular:</label>
                            <input type="text" class="form-control" id="celular"  name="celular" value="{{$empresa->celular}}"
                                   pattern="[0-9_-]*">
                            <div class="invalid-feedback"> Ingrese un celular valido (número y guiones permitidos)</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Correo electrónico:</label>
                            <input type="text" class="form-control" id="correo"  name="correo" value="{{$empresa->correo}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
                            <div class="invalid-feedback"> Ingrese un correo electrónico valido</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Departamento:</label>
                            <select class="form-control" name="id_departamento" id="departamento" required>

                                @foreach($GetUbicacion->getDepartamento($empresa['id_departamento']) as $index => $departamento)
                                    <option value="{{ $index }}">{{ $departamento }}</option>
                                @endforeach

                                @foreach($GetUbicacion->getDepartamento() as $index=>$departamento)
                                    <option value="{{ $index }}">{{ $departamento }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Seleccione un departamento</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Provincia:</label>
                            <select class="form-control" name="id_provincia" id="provincia" required>
                                @foreach($GetUbicacion->getProvincia($empresa->id_provincia) as $index => $provincia)
                                    <option value="{{ $index }}">{{ $provincia }}</option>
                                @endforeach
                                <option value="">Seleccione una provincia</option>
                            </select>
                            <div class="invalid-feedback">Seleccione una provincia</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="validationCustom01"><br>Distrito:</label>
                            <select class="form-control" name="id_distrito" id="distrito" required>
                                @foreach($GetUbicacion->getDistrito($empresa->id_distrito) as $index => $distrito)
                                    <option value="{{ $index }}">{{ $distrito }}</option>
                                @endforeach
                                <option value="">Seleccione un distrito</option>
                            </select>
                            <div class="invalid-feedback">Seleccione un distrito</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="validationCustom01"><br>Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{$empresa->direccion}}"
                                   style="text-transform: uppercase" onkeyup="this.value.toUpperCase();" required>
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
                                @if($empresa->estado == 'activo')
                                    <option value="{{$empresa->estado}}">{{strtoupper($empresa->estado)}}</option>
                                    <option value="inactivo">INACTIVO</option>
                                @elseif($empresa->estado == 'inactivo')
                                    <option value="{{$empresa->estado}}">{{strtoupper($empresa->estado)}}</option>
                                    <option value="activo">ACTIVO</option>
                                @endif
                            </select>
                            <div class="invalid-feedback">Seleccione un estado</div>
                            <div class="valid-feedback">Correcto.</div>
                        </div>
                    </div>
                    <button class="btn btn-secondary my-5" type="submit" id="crear_rango">Actualizar empresa</button>
                </form>
            </div>
        </div>
        <hr>
    </div>
@endsection
@section('javascript-optional')
    <script src="{{ asset('js/empresa.js') }}"></script>
@endsection

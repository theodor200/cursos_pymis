@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h2 class="text-uppercase">Datos de la empresa <b>{{ $empresa->razon_social }}</b></h2>
                <hr class="my-4">
                <p class="font-weight-normal mt-2 mb-2">Vista de los datos almacenados.</p>
            </div>
        </div>
        <hr class="my-4">


        <div class="col-12">
            <div class="row my-3" style="vertical-align: center;">
                <h5 class=" text-uppercase ">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Información general:</h5>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Razón social: </span>{{ strtoupper($empresa->razon_social)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Número de R.U.C: </span>{{ strtoupper($empresa->ruc)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Rubro comercial de la empresa: </span>{{ strtoupper($empresa->rubro)}}</p>
            </div>

            <hr>

            <div class="row my-3">
                <h5 class=" text-uppercase ">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Dominio de la empresa:</h5>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Dominio: </span>{{ strtoupper($empresa->dominio)}}</p>
            </div>

            <hr>

            <div class="row">
                <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                <h5 class=" text-uppercase"> Cantidad de alumnos registrados en esta empresa:
                    <b>{{\App\Alumnos::where('id_empresa','=',$empresa->id)->count()}}</b>
                </h5>
            </div>

            <hr>

            <div class="row my-3">
                <h5 class="text-uppercase my-3">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Contácto:</h5>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon>
                    Nombre del contácto: </span>{{ strtoupper($empresa->contacto)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Número de celular: </span>{{ strtoupper($empresa->celular)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Correo electrónico: </span>{{ strtoupper($empresa->correo)}}</p>
            </div>

             <hr>

            <div class="row my-3">
                <h5 class=" text-uppercase" style="text-align: center;">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Ubicación:</h5>
            </div>
            <div class="row ml-4">
                @foreach($GetUbicacion->getDepartamento($empresa->id_departamento) as $index => $departamento)
                    <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Departamento: </span>{{ strtoupper($departamento)}}</p>
                @endforeach
            </div>
            <div class="row ml-4">
                @foreach($GetUbicacion->getProvincia($empresa->id_provincia) as $index => $provincia)
                    <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Provincia: </span>{{ strtoupper($provincia)}}</p>
                @endforeach
            </div>
            <div class="row ml-4">
                @foreach($GetUbicacion->getDistrito($empresa->id_distrito) as $index => $distrito)
                    <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Distrito: </span>{{ strtoupper($distrito)}}</p>
                @endforeach
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Dirección: </span>{{ strtoupper($empresa->direccion)}}</p>
            </div>
        </div>
        <hr>
        <a href="{{ route('empresas.index') }}" class="btn btn-secondary"><ion-icon name="arrow-back-outline" style="vertical-align: middle"></ion-icon> Regresar al listado de empresas</a>
    </div>
@endsection
@section('javascript-optional')
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
@endsection

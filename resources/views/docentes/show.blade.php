@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h2 class="text-uppercase">Datos del docente: <b>{{ $docente->nombres }}</b></h2>
                <hr class="my-4">
                <p class="font-weight-normal mt-2 mb-2">Vista de los datos almacenados.</p>
            </div>
        </div>
        <hr class="my-4">
        @php
            $user =  \App\User::where('id','=',$docente->user_id)->first();
        @endphp

        <div class="col-12">
            <div class="row my-3" style="vertical-align: center;">
                <h5 class=" text-uppercase ">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Información general:</h5>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Nombre(s) y apellidos: </span>{{ strtoupper($user->name)}}</p>
            </div>

            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> D.N.I: </span>{{ strtoupper($docente->dni)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Celular: </span>{{ strtoupper($docente->celular)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Fecha de nacimiento: </span>{{ strtoupper($docente->fecha_nacimiento)}}</p>
            </div>

            <hr>

            <div class="row my-3">
                <h5 class=" text-uppercase ">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Estudio y grado:</h5>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Centro de estudios: </span>{{ strtoupper($docente->centro_estudios)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Grado de estudios: </span>{{ strtoupper($docente->grado)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Profesión: </span>{{ strtoupper($docente->profesion)}}</p>
            </div>

            <hr>

            <div class="row">
                <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                <h5 class=" text-uppercase">
                    Estado del docente:
                </h5>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> {{ strtoupper($docente->estado)}}</p>
            </div>
        </div>
        <hr>
        <a href="{{ route('docentes.index') }}" class="btn btn-secondary"><ion-icon name="arrow-back-outline" style="vertical-align: middle"></ion-icon> Regresar a listado de docentes</a>
    </div>
@endsection
@section('javascript-optional')
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
@endsection

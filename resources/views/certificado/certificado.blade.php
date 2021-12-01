@extends('layouts.certificado')
@section('css-opcional')
    <style>
        .certificado{
            background-color: #fff;
            border-radius: 20px;

        }
    </style>
@endsection
@section('content')
    <div class="container-fluid certificado" style="border: 5px solid #436a47; padding: 50px 0;">
        
        <div class="col-12 text-right" style="margin-bottom: 10px;"> Certificado N° ID - @php echo rand(1000, 9999) . rand(1000, 9999) @endphp
        </div>
        <div class="col-12 text-center">
            @if($curso->logotipo == NULL)
                <img src={{ asset('storage/logo-pymis.png')}} width=250/>
            @else
                <img src={{ asset('storage/'.$curso->logotipo)}} width=250/>
            @endif
            
        </div>
        <div class="col-12 text-center">
            <h1 style="font-style: italic; font-size: 2.3rem;text-decoration: underline;text-decoration-color: #436a47;text-underline-position: under;">Certificado</h1>
        </div>
        <div class="col-12 text-center">
            <h2 style="font-style: italic; font-size: 2rem; margin-top: 20px;">Otorgado a:</h2>
        </div>
        <div class="col-12 text-center">
            <h2 style="font-weight: bolder; font-size: 2rem; margin-top: 10px;">Certificado de ejemplo</h2>
        </div>
        <div class="col-12 text-center">
            <h5 style="font-style: italic; font-size: 2rem; margin-top: 10px;">Por haber asistido como participante al curso:</h5>
        </div>
        <div class="col-12 text-center mb-4">
            <h2 style="font-style: italic; font-size: 2rem; margin-top: 20px; text-transform: uppercase;">"{{strtoupper($curso->nombre)}}"</h2>
        </div>
        @if($curso->fecha_inicio == $curso->fecha_fin)
            <div class="col-12 text-center" style="font-style: italic;">
                @php
                    \Carbon\Carbon::setLocale('es');
                     $fecha = \Carbon\Carbon::parse($curso->fecha_fin);
                     echo '<h5 class="mt-2">
                     Llevado a cabo el '.ucfirst($fecha->dayName).' '.$fecha->day.' de '.ucfirst($fecha->locale('es')->monthName).' del '.$fecha->year.'</h5>';
                @endphp
                @if($curso->hora_curso !== NULL)
                    <h5 class="mt-2">Cantidad de horas dictadas: {{$curso->hora_curso}}</h5>
                @endif
            </div>
        @else<div class="col-12 text-center" style="font-style: italic;">
            @php
                \Carbon\Carbon::setLocale('es');
                 $fecha_inicio = \Carbon\Carbon::parse($curso->fecha_inicio);
                 $fecha_fin = \Carbon\Carbon::parse($curso->fecha_fin);
                 echo '<h5 class="mt-2">
                 Llevado a cabo desde el:<br><br>'.
                 ucfirst($fecha_inicio->dayName).' '.$fecha_inicio->day.' de '.ucfirst($fecha_inicio->locale('es')->monthName).' del '.$fecha_inicio->year.'
                  al  '.
                  ucfirst($fecha_fin->dayName).' '.$fecha_fin->day.' de '.ucfirst($fecha_fin->locale('es')->monthName).' del '.$fecha_fin->year.
                  '</h5>';
            @endphp
            @if($curso->hora_curso !== NULL)
                <h5 class="mt-2">Cantidad de horas dictadas: {{$curso->hora_curso}}</h5>
            @endif
        </div>
        @endif
        <div class="row">
            <div class="col-12 text-center" style="margin-top: 40px;">
                <img src="{{asset('img/firma.png')}}" height="130">
                <p>Ing. Rene Atencio<br>Gerente PYMIS</p>
            </div>

        </div>




    </div>
@endsection
@section('javascript-optional')

@endsection

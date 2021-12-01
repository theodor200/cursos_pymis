@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h2 class="text-uppercase">Datos del curso : <b>{{ $curso->nombre }}</b></h2>
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
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Nombre del curso: </span>{{ strtoupper($curso->nombre)}}</p>
            </div>

            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Categoría del curso: </span>
                    {{ strtoupper(\Illuminate\Support\Facades\DB::table('categorias_cursos')->where('id','=',$curso->id_categoria)->first()->nombre)}}
                </p>
            </div>

            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Promedio mínimo para aprobar el curso: </span>{{ strtoupper($curso->promedio_minimo)}}</p>
            </div>

            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Logotipo del certificado: </span>
                    @if($curso->logotipo == NULL)
                        <img src={{ asset('storage/logo-pymis.png')}} width=250/>
                    @else
                        <img src={{ asset('storage/'.$curso->logotipo)}} width=250/>
                    @endif
                    
                </p>
            </div>

            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Costo en soles S/. </span>{{ strtoupper($curso->costo)}}</p>
            </div>

            <hr>

            <div class="row my-3">
                <h5 class=" text-uppercase" style="text-align: center;">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Ubicación donde se dictará el curso:</h5>
            </div>
            <div class="row ml-4">
                @foreach($GetUbicacion->getDepartamento($curso->id_departamento) as $index => $departamento)
                    <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Departamento: </span>{{ strtoupper($departamento)}}</p>
                @endforeach
            </div>
            <div class="row ml-4">
                @foreach($GetUbicacion->getProvincia($curso->id_provincia) as $index => $provincia)
                    <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Provincia: </span>{{ strtoupper($provincia)}}</p>
                @endforeach
            </div>
            <div class="row ml-4">
                @foreach($GetUbicacion->getDistrito($curso->id_distrito) as $index => $distrito)
                    <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Distrito: </span>{{ strtoupper($distrito)}}</p>
                @endforeach
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Dirección: </span>{{ strtoupper($curso->direccion)}}</p>
            </div>

            <div class="row my-3">
                <h5 class=" text-uppercase" style="text-align: center;">
                    <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                    Fechas:</h5>
            </div>

            <hr>

            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Fecha de inicio: </span>{{ strtoupper($curso->fecha_inicio)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Fecha de fin: </span>{{ strtoupper($curso->fecha_fin)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Horas del curso: </span>{{ $curso->hora_curso}}</p>
            </div>

            <hr>

            <div class="row">
                <ion-icon name="checkmark-circle" style="font-size: 25px; vertical-align: middle;"></ion-icon>
                <h5 class=" text-uppercase">
                    Estado del curso:
                </h5>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon>Estado: {{ strtoupper($curso->estado)}}</p>
            </div>

            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon> Vacantes: {{ strtoupper($curso->vacantes)}}</p>
            </div>




        </div>
        <hr>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary"><ion-icon name="arrow-back-outline" style="vertical-align: middle"></ion-icon> Regresar al listado de cursos.</a>
    </div>
@endsection
@section('javascript-optional')
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
@endsection

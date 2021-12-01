@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h2 class="text-uppercase">Datos de la categoría de curso : <b>{{ $catCurso->nombre }}</b></h2>
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
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Nombre: </span>{{ strtoupper($catCurso->nombre)}}</p>
            </div>
            <div class="row ml-4">
                <p><ion-icon name="play" style="font-size: 20px; vertical-align: middle;"></ion-icon><span> Número de cursos asignados a esta categoría: </span>
                    {{ \Illuminate\Support\Facades\DB::table('cursos')->where('id_categoria','=',$catCurso->id)->count() }}
                </p>
            </div>

        </div>
        <hr>
        <a href="{{ route('categorias_cursos.index') }}" class="btn btn-secondary"><ion-icon name="arrow-back-outline" style="vertical-align: middle"></ion-icon> Regresar a listado de categoria de curso</a>
    </div>
@endsection
@section('javascript-optional')
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
@endsection

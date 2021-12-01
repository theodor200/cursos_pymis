@extends('layouts.app-access')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="d-inline-block">Lista de módulos del curso : {{strtoupper($curso->nombre)}} </h3>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombres de módulo</th>
                        <th scope="col">Archivo de módulo</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Fecha de actualización</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modulos as $modulo)
                        @if($modulo->estado == 'Activo')
                        <tr>
                            <td>{{strtoupper($modulo->nombre)}}</td>
                            @if(empty($modulo->file))
                                <td>Este módulo no tiene archivos.</td>
                            @else
                                <td>{{strtoupper($modulo->file)}}
                                    <a class="badge badge-pill badge-dark" href="{{url('files/'.$modulo->file)}}" target="_blank"> VER ARCHIVO </a>
                                </td>
                            @endif
                            <td>{{strtoupper($modulo->created_at)}}</td>
                            <td>{{strtoupper($modulo->updated_at)}}</td>
                        </tr>
                        @else

                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('javascript-optional')
@endsection

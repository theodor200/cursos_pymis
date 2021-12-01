@extends('layouts.app-access')
@section('content')
    @inject('GetUbicacion','App\Services\GetUbicacion')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="d-inline-block">Lista de asignación de cursos registrados </h2>
                        <a href="{{url('/asignacion_cursos/create')}}" class="btn btn-primary btn-lg float-right ml-2">Crear asignación de curso</a>
                        <a href="{{url('/excel_asignacion_cursos')}}" class="btn btn-secondary btn-lg float-right">Exportar a excel</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Docente</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Estado del curso</th>
                                <th scope="col">Categoría del curso</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($acursos as $acurso)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                                    @php $docentes = \Illuminate\Support\Facades\DB::table('users')->where([['id','=',$acurso->id_docente],['role','=','docente']])->get(); @endphp
                                    <td> @foreach ($docentes as $docente)
                                        {{ strtoupper($docente->name) }}
                                        @endforeach
                                    </td>

                                    @php $cursos = \Illuminate\Support\Facades\DB::table('cursos')->where('id','=',$acurso->id_curso)->get(); @endphp

                                    @foreach ($cursos as $curso)
                                        <td>
                                                {{ strtoupper($curso->nombre) }}
                                                @php $id_catcurso = $curso->id_categoria; @endphp
                                        </td>
                                        <td>
                                            {{ strtoupper($curso->estado) }}
                                        </td>
                                    @endforeach

                                    @php $catcursos = \Illuminate\Support\Facades\DB::table('categorias_cursos')->where('id','=',$id_catcurso)->get(); @endphp
                                    <td> @foreach ($catcursos as $catcurso)
                                            {{ strtoupper($catcurso->nombre) }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($curso->estado == 'Terminado')
                                        CURSO TERMINADO.
                                        @else
                                        <a class="d-block float-left mx-2" href="{{ url('asignacion_cursos/'.$acurso->id.'/edit')}}"><ion-icon size="large" name="create-outline"></ion-icon></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript-optional')
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
@endsection

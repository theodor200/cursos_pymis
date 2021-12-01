<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PYMIS') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css-opcional')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #563D7C;">
        <!--<nav class="navbar navbar-dark bg-dark navbar-expand-lg">-->
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @php $role =  \Illuminate\Support\Facades\Auth::user()->role; @endphp

                        @if($role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/empresas') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                Empresas
                            </a>
                        </li>
                        @endif

                        @if($role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/docentes') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                Docentes
                            </a>
                        </li>
                        @endif

                        @if($role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/categorias_cursos') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                Categoría de cursos
                            </a>
                        </li>
                        @endif

                        @if($role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/cursos') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                Cursos
                            </a>
                        </li>
                        @endif

                        @if($role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/asignacion_cursos') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                Asignación de cursos
                            </a>
                        </li>
                        @endif

                        @if($role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/alumnos') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    Alumnos
                                </a>
                            </li>
                        @endif

                        {{-- Menu para docentes --}}
                        @if($role == 'docente')
                            @php
                                $user_id = Auth::user()->id;
                                $perfil_docente = \App\PerfilDocente::where('user_id','=',$user_id)->first();
                                $id_perfil = $perfil_docente->id;
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/perfil_docente/'.$id_perfil.'/edit') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    Mi perfil
                                </a>
                            </li>
                        @endif

                        @if($role == 'docente')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/mis_cursos_asignados/'.$user_id) }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    Cursos asignados
                                </a>
                            </li>
                        @endif

                        {{-- Menu para alumnos --}}
                        @if($role == 'alumno')
                            @php
                                $user_id = Auth::user()->id;
                                $perfil_alumno = \App\PerfilAlumno::where('user_id','=',$user_id)->first();
                                $id_perfil = $perfil_alumno->id;
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/perfil_alumno/'.$id_perfil.'/edit') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    Mi perfil
                                </a>
                            </li>
                        @endif

                        @if($role == 'alumno')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/inscripciones_cursos') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    Cursos
                                </a>
                            </li>
                        @endif

                        @if($role == 'alumno')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/ver_notas/'.Auth::user()->id) }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    Mis notas
                                </a>
                            </li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ strtoupper(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{'Salir'}}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-2 m-0">
            @yield('content')
        </main>
    </div>

    <!-- Window Modal -->
    <div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">MENSAJE DEL SISTEMA:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Window Modal MENSAJE -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a href="#delete" id="a-delete" style="display: none"><button type="button" class="btn btn-primary">Elimnar</button></a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascript-optional')

</body>
</html>



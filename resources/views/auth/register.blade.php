@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">

                        <nav class="position-absolute fixed-top navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <!-- Right Side Of Navbar -->
                                <ul class="nav ml-auto mt-4">
                                    <!-- Authentication Links -->
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-outline-secondary" href="{{ route('login') }}">{{ __('Inicia sesión') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                        <div class="row">
                            <div class="col-md-8 col-lg-9 mx-auto">
                                <!--<img src="https://www.pymis.com.pe/wp-content/uploads/2019/05/logo-pymis_n.png"
                                     class="d-block mx-auto mb-2" alt="">-->
                                <h3 class="login-heading mb-4 text-center">Registrate</h3>
                                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                    @csrf
                                    <input type="text" id="route" value="{{ route('register') }}" readonly hidden>
                                    <input type="text" id="redirect" value="{{url('email/verify')}}" readonly hidden>

                                    <div class="form-label-group">
                                        <input id="inputName" type="text" class="form-control" name="name" placeholder="Ingrese un nombre"
                                               value="{{ old('name') == '' ? '' : old('name')}}" required autocomplete="name" autofocus>
                                        <label for="inputName">Nombre:</label>
                                        <div class="valid-feedback ml-4"></div>
                                        <div class="invalid-feedback ml-4">Ingrese un nombre.</div>
                                    </div>

                                    <div class="form-label-group">
                                        <input id="inputEmail" type="email" class="form-control" name="email" placeholder="Ingrese un correo electrónico"
                                               value="{{ old('mail') == '' ? '' : old('mail')}}" required autocomplete="email">
                                        <label for="inputEmail">Correo electrónico:</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @else
                                                <div class="invalid-feedback ml-4">Ingrese un correo válido.</div>
                                            @enderror
                                    </div>

                                    <div class="form-label-group">
                                        <input id="inputPassword" type="password" class="form-control" name="password" placeholder="Ingrese una contraseña" required autocomplete="new-password">
                                        <label for="inputPassword">Contraseña:</label>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @else
                                                <div class="invalid-feedback ml-4">Ingrese una contraseña:</div>
                                            @enderror
                                        </div>

                                    <div class="form-label-group">
                                        <input id="input-password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password">
                                        <label for="input-password-confirm">Confimar contraseña</label>
                                        <div class="invalid-feedback ml-4">Confirmar contraseña.</div>
                                    </div>
                                            <button type="submit" class="btn btn-primary btn-lg btn-login text-uppercase font-weight-bold d-block mx-auto px-4">
                                                Registrame
                                            </button>
                                </form>
                            </div>
                        </div>
                        <div hidden class="alert alert-info col-md-8 mx-auto text-center mt-4" role="alert" id="alert_server">
                            <strong>Aviso: </strong><p class="d-inline"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/form-validate.js') }}"></script>
@endsection
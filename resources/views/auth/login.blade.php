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
                                            <a class="nav-link btn btn-outline-secondary" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                        </li>
                                    </ul>
                                </div>
                        </nav>

                        <div class="row">
                            <div class="col-md-8 col-lg-9 mx-auto">

                            <!--<img src="https://www.pymis.com.pe/wp-content/uploads/2019/05/logo-pymis_n.png"
                                 class="d-block mx-auto mb-2" alt="">-->

                            <h3 class="login-heading mb-4 text-center">Centro de capacitación empresarial.</h3>
                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                                <input type="text" id="route" value="{{ route('login') }}" readonly hidden>
                                <input type="text" id="redirect" value="{{ route('home') }}" readonly hidden>

                                @csrf
                                <div class="form-label-group">
                                    <input id="inputEmail" type="email" class="form-control" name="email" placeholder="Email address" required autocomplete="email"
                                           value=" {{ old('email') == '' ? '' : old('email')}} ">
                                    <label for="inputEmail">Correo electrónico:</label>
                                    <div class="valid-feedback ml-4"></div>
                                    <div class="invalid-feedback ml-4">Ingrese un correo electrónico válido.</div>
                                </div>

                                <div class="form-label-group">
                                    <input id="inputPassword" type="password" class="form-control" name="password" required placeholder="Contraseña" autocomplete="current-password">
                                    <label for="inputPassword">Contraseña:</label>
                                            <div class="valid-feedback ml-4"></div>
                                            <div class="invalid-feedback ml-4">Ingrese una contraseña.</div>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Recordar contraseña.</label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-login text-uppercase font-weight-bold d-block mx-auto px-4" type="submit">Entrar</button>

                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">¿Desea recuperar su contraseña?</a>
                                    @endif
                                </div>
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

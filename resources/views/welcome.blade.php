<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PYMIS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background-image: url('https://www.pymis.com.pe/wp-content/uploads/2017/12/fondoslider.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 50px;
        }

        /*.links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }*/

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="col-md-12">
            <img src="https://www.pymis.com.pe/wp-content/uploads/2019/05/logo-pymis_n.png" class="mx-auto d-block mb-4" alt="Pymis.com.pe">
            <div class="title m-b-md">
                Bienvenido al centro de capacitación.
            </div>
            @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/home') }}" class="btn text-uppercase" style="background-color: #828D8D; color:#fff;">Ir a panel de control</a>
                    @else
                        <a href="{{ route('login') }}" class="btn text-uppercase" style="background-color: #828D8D; color:#fff;">Iniciar sesión</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn text-uppercase" style="background-color: #828D8D; color:#fff;">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>

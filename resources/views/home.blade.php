@section('css-opcional')
    <style>

        body {
            background-color: #fff;
            color: #636b6f;
            background-image: url('https://www.pymis.com.pe/wp-content/uploads/2017/12/fondoslider.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .full-height {height: 100vh;}

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {position: relative;}

        .content { text-align: center;}

        .title {font-size: 2rem; font-family: "Nunito", sans-serif; color: #000}

        .m-b-md { margin-bottom: 30px;}
    </style>
@endsection
@extends('layouts.app-access')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="col-md-12">
                <div class="title m-b-md" style="color:#333">
                    Bienvenid@ {{ strtoupper(\Illuminate\Support\Facades\Auth::user()->name)}}
                </div>
            </div>
        </div>
    </div>
@endsection

@component('mail::message')
<b>Hola {{strtoupper(\Illuminate\Support\Facades\Auth::user()->name)}}</b> <br><br>
Te damos la bienvenida al curso:<br>
<h1>{{strtoupper($curso->nombre)}}</h1>
<p>Fecha de inicio: {{$curso->fecha_inicio}} <br> Fecha de fin: {{$curso->fecha_fin}}</p>
@component('mail::button', ['url' => '/login'])
Ingresar
@endcomponent
Gracias por inscribirte,<br>
{{ config('app.name') }}
@endcomponent

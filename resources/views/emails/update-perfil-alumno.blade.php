@component('mail::message')
<b>Hola profesor(a) {{strtoupper($user['name'])}}</b> <br><br>
@if($user['admin'])
    El administrador del sistema actualizo tu perfil:
@else
    Has actualizado tu perfil:
@endif

@php
$alumno = \App\PerfilAlumno::where('user_id','=',$user['id'])->get();
@endphp
<ul>
@foreach($alumno as $perfil)
        <li>Empresa: {{ strtoupper($user['empresa']) }}</li>
        <li>Nombre: {{ strtoupper($user['name']) }}</li>
        <li>DNI: {{$perfil->dni}}</li>
        <li>Fecha de nacimiento: {{$perfil->fecha_nacimiento}}</li>
        <li>Celular: {{$perfil->celular}}</li>
        <li>Cargo: {{strtoupper($perfil->cargo)}}</li>
        <li>Dirección: {{strtoupper($perfil->direccion)}}</li>
@endforeach
</ul>
Gracias por aprender con nosotros,<br>
{{ config('app.name') }}
@endcomponent

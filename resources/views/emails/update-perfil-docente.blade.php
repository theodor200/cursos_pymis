@component('mail::message')
<b>Hola profesor(a) {{strtoupper($user['name'])}}</b> <br><br>
@if($user['admin'])
    El administrador del sistema actualizo tu perfil:
@else
    Has actualizado tu perfil:
@endif

@php
$docente = \App\Docentes::where('user_id','=',$user['id'])->get();
@endphp
<ul>
@foreach($docente as $perfil)
        <li>Nombre: {{ strtoupper($user['name']) }}</li>
        <li>DNI: {{$perfil->dni}}</li>
        <li>Fecha de nacimiento: {{$perfil->fecha_nacimiento}}</li>
        <li>Celular: {{$perfil->celular}}</li>
        <li>Profesión: {{strtoupper($perfil->profesion)}}</li>
        <li>Grado de estudios: {{strtoupper($perfil->grado)}}</li>
        <li>Centro de estudios: {{strtoupper($perfil->centro_estudios)}}</li>
        <li>Estado: {{strtoupper($perfil->estado)}}</li>
@endforeach
</ul>
Gracias por ser parte del equipo,<br>
{{ config('app.name') }}
@endcomponent

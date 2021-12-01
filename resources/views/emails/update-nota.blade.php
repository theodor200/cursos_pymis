@component('mail::message')
@php
$ins = \App\InscripcionesCursoAlumno::where('id','=',$nota['inscripcion_id'])->first();
$user = \App\User::where('id','=',$ins->user_id)->first();
$curso = \App\Cursos::where('id','=',$ins->id_curso)->first();
@endphp
<b>Hola {{strtoupper($user->name)}} </b> <br><br>
<p>Se actualizaron tus notas en el curso <b>{{strtoupper($curso->nombre)}}</b></p>
<ul>
    <li>Nota 01: {{ $nota['nota1'] }}</li>
    <li>Nota 02: {{ $nota['nota2'] }}</li>
    <li>Nota 03: {{ $nota['nota3'] }}</li>
    <li>Nota 04: {{ $nota['nota4'] }}</li>
    <li>Promedio: {{ $nota['promedio'] }}</li>
</ul>
Gracias por aprender con nosotros,<br>
{{ config('app.name') }}
@endcomponent

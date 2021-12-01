@component('mail::message')
<b>Hola {{strtoupper(\Illuminate\Support\Facades\Auth::user()->name)}}</b> <br><br>
Lamentamos que te retires de este curso: <b>{{strtoupper($curso->nombre)}}</b>.<br>
Esperamos verte de nuevo muy pronto.

Gracias por participar,<br>
{{ config('app.name') }}
@endcomponent

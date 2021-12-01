@component('mail::message')
<b>Hola profesor(a) {{ strtoupper($user['name'])}}</b> <br><br>
@if($user['admin'])
    El administrador del sistema actualizo tus credenciales de acceso:
@else
    Has actualizado tus credenciales de acceso:
@endif
<ul>
    <li>Usuario: {{$user['email']}}</li>
    <li>Nueva contraseña: {{$user['password']}}</li>
</ul>
@component('mail::button', ['url' => '/login'])
        Ingresar
@endcomponent
Nota:
@if($user['admin'])
    <ul>
        <li>El administrador actualizo tu contraseña de acceso, si deseas cambiarla puedes hacerlo desde este link <a href="{{url('password/reset')}}">Restablecer contraseña</a> colocando tu usuario.</li>
    </ul>
@else
    <ul>
        <li>Si deseas restablecer solo la contraseña puedes hacerlo desde este link <a href="{{url('password/reset')}}">Restablecer contraseña</a> colocando tu usuario.</li>
    </ul>
@endif

Gracias por aprender con nosotros,<br>
{{ config('app.name') }}
@endcomponent

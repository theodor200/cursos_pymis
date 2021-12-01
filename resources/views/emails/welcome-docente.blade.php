@component('mail::message')
    <b>Bienvenid@ profesor(a) {{strtoupper($user['name'])}}</b> <br><br>
Su credencial de acceso es:
<ul>
    <li>Nombre: {{strtoupper($user['name'])}}</li>
    <li>Usuario: {{$user['email']}}</li>
    <li>Password: {{$user['password']}}</li>
</ul>

Para acceder al centro de capacitación da click en el siguiente botón.<br>

@component('mail::button', ['url' => url('/login')])
Ingresar
@endcomponent
A tener en consideración:
    <ul>
        <li>Si olvidaste tu contraseña puedes restablecerla desde este link <a href="{{url('password/reset')}}">Restablecer contraseña</a> colocando tu usuario.</li>
    </ul>
Gracias por ser parte del equipo,<br>
{{ config('app.name') }}
@endcomponent

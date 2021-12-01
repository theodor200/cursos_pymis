@component('mail::message')
 <b>Hola {{$user->name}}</b> <br><br>
Bienvenido al centro de capacitación de Pymis:<br>
Tu usuario de acceso al sistema es:
<ul>
    <li>Usuario: {{$user->email}}</li>
</ul>
Para acceder al centro de capacitación da click en el siguiente botón.<br>

@component('mail::button', ['url' => '/login'])
Ingresar
@endcomponent
A tener en consideración:
    <ul>
        <li>Se te envió un correo para verificar tu email, no olvides hacerlo. Si ya lo verificaste omite este texto.</li>
        <li>Si olvidaste tu contraseña puedes restablecerla desde este link <a href="{{url('password/reset')}}">Restablecer contraseña</a> colocando tu usuario.</li>
    </ul>
Gracias por inscribirte,<br>
{{ config('app.name') }}
@endcomponent

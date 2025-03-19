<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss'])
</head>

<body style="background-color: #23023bb7;">

    <nav class="Mynavbar">
        @if (!Auth::check())
            <a href="{{ url('/login') }}">
                <div class="IniciarSesion">
                    Iniciar Sesion
                </div>
            </a>
            <img src="{{ asset('image/logo.png') }}" alt="my logo">
            <a href="{{ url('/register') }}">
                <div class="Registrarse">
                    Registrarse
                </div>
            </a>
        @else
            <div class="name">
                ¡Bienvenido, {{ Auth::user()->nombre }}!
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>
            </div>
            <img src="{{ asset('image/logo.png') }}" alt="my logo">
            @if (Auth::user()->roles_id_rol == 2)
                <div class="AdminMensaje">
                    ¡Eres administrador! Tienes acceso completo.
                </div>
            @else
            <div class="AdminMensaje">
                No eres Administrador
                <div>

            @endif
        @endif

    </nav>
    <header class="ContenidoPrincipalDelXD">
        @yield('ContenidoPrincipalQueSeMuestra')
    </header>
    <footer class="Myfooter">
        <div class="Myfooter1">
            <div class="MyFooterDiv">
                Ubicación: C/Caracola 12, 08917, Barcelona
            </div>
            <div class="MyFooterDiv">
                Contacto: gg@gmail.com
            </div>
            <div class="MyFooterDiv">
                Siguenos en:
                <img src="{{ asset('image/facebook.png') }}" alt="my logo">
                <img src="{{ asset('image/instagram.png') }}" alt="my logo">
                <img src="{{ asset('image/twitter.png') }}" alt="my logo">
                <img src="{{ asset('image/discord.png') }}" alt="my logo">
            </div>
        </div>
        <div class="Myfooter2">
            © 2024 GG Gamers. Todos los derechos reservados. Términos y Condiciones | Política de Privacidad
        </div>
    </footer>
</body>

</html>

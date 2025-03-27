<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss','resources/js/pablo.js'])
</head>
<body class="BodyClass">

    <nav class="Mynavbar">
        @if (!Auth::check())
            <a href="{{ url('/login') }}" class="PreNavBar">
                <div class="IniciarSesion">
                    Iniciar Sesion
                </div>
            </a>
            <img src="{{ asset('image/logo.png') }}" alt="my logo">
            <a href="{{ url('/register') }}" class="PreNavBar">
                <div class="Registrarse">
                    Registrarse
                </div>
            </a>
        @else
            @if (Auth::user()->roles_id_rol == 2)
            <div class="UsuarioIcono">
                <div class="icono">
                    <div class="OpcionDesalir">

                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="BotonDeAdministarr">Administrar</button>
                </form>
            </div>
            @else
            <div class="UsuarioIcono">
                <div class="icono">
                    <div class="OpcionDesalir">

                    </div>
                </div>
            </div>
            @endif

            <img src="{{ asset('image/logo.png') }}" alt="my logo">
            {{-- @if (Auth::user()->roles_id_rol == 2) --}}
            <div class="BotonesDeLasOpciones">
                <a href="{{ url('/') }}" class="PostNavBar">
                    <div class="Myboton">Torneos</div>
                </a>
                <a href="{{ url('/') }}" class="PostNavBar">
                    <div class="Myboton">Sobre Nosotros</div>
                </a>
            </div>
        @endif

    </nav>
    <header class="ContenidoPrincipalDelXD">
        @yield('ContenidoPrincipalQueSeMuestra')
    </header>
    <main class="ContenidoMain">
        @yield('ContenidoDelMainMaldicion')
    </main>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</html>

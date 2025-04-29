<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GG Gamers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="icon" href="{{ asset('image/logo/logo.png') }}" type="image/x-icon">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss','resources/js/Navbar.js','resources/css/torneos.css', 'resources/css/nosotros.css', 'resources/js/nosotros.js'])
</head>
<body class="BodyClass">

    <nav class="Mynavbar">
        @if (!Auth::check())
            <a href="{{ url('/login') }}" class="PreNavBar" tabindex="1" >
                <div class="IniciarSesion">
                    Iniciar Sesión
                </div>
            </a>
            <a href="{{ url('/') }}">
                <img src="{{ asset('image/logo/logo.png') }}" alt="my logo">
            </a>
            <a href="{{ url('/register') }}" class="PreNavBar" tabindex="2">
                <div class="Registrarse">
                    Registrarse
                </div>
            </a>
        @else
            @if (Auth::user()->roles_id_rol == 2)
            <div class="UsuarioIcono">
                <div class="icono">
                    @if (Auth::user()->ImagenRuta)
                    <img src="{{ asset(Auth::user()->ImagenRuta) }}" alt="Logo del usuario">
                @else
                    <img src="{{ asset('image/logo/usuario.png') }}" alt="Usuario">
                @endif
                    <div class="OpcionDesalir">
                        <form action="{{ route('Administrador', ['id_usuario' => Auth::user()->id_usuario]) }}" method="GET">
                            <button type="submit" class="BotondeMirar">Mirar Perfil</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="BotondeLogots">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="UsuarioIcono">
                <div class="icono">
                @if (Auth::user()->ImagenRuta)
                    <img src="{{ asset(Auth::user()->ImagenRuta) }}" alt="Logo del usuario">
                @else
                    <img src="{{ asset('image/logo/usuario.png') }}" alt="Usuario">
                @endif
                    <div class="OpcionDesalir">
                        <form action="{{ route('Profile', ['id_usuario' => Auth::user()->id_usuario]) }}" method="GET">
                            <button type="submit" class="BotondeMirar">Mirar Perfil</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="BotondeLogots">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <a href="{{ url('/') }}">
                <img src="{{ asset('image/logo/logo.png') }}" alt="my logo"  >
            </a>
            {{-- @if (Auth::user()->roles_id_rol == 2) --}}
            <div class="BotonesDeLasOpciones">
                <a href="{{ url('/torneos') }}" class="PostNavBar">
                    <div class="Myboton">Torneos</div>
                </a>
                <a href="{{ url('/sobre-nosotros') }}" class="PostNavBar">
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
                Ubicación: Plaza Urquinaona, 08010, Barcelona
            </div>
            <div class="MyFooterDiv">
                Contacto: gggamers@gmail.com
            </div>
            <div class="MyFooterDiv">
                Síguenos en:
                <a href="https://www.facebook.com/profile.php?id=61574844856450" target="_blank">
                    <img src="{{ asset('image/logo/facebook.png') }}" alt="my logo">
                </a>
                <a href="https://x.com/GGGamers178098"  target="_blank">
                    <img src="{{ asset('image/logo/twitter.png') }}" alt="my logo">
                </a>
                <a href="https://www.instagram.com/gggamersoficial/" target="_blank">
                    <img src="{{ asset('image/logo/instagram.png') }}" alt="my logo">
                </a>
                <img src="{{ asset('image/logo/discord.png') }}" alt="my logo">
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

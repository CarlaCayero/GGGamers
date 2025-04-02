@extends('Layouts.layouts')
@section('ContenidoPrincipalQueSeMuestra')
    <img src="{{ asset('image/logo/index.gif') }}" alt="my logo" class="IMGINDEX">

    <div class="shadow-dance-container">
        <h1 class="shadow-dance-text">ÚNETE</h1>
    </div>
    <div class="ContenidoTexto">
        <p>
            Toma tu lugar entre los campeones.
            Selecciona tu juego y que comience el desafío.
        </p>
    </div>
@endsection

@section('ContenidoDelMainMaldicion')
    <div class="carouselIndex">
        <h2>Nuestro catálogo</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/cod6.png') }}" alt="Imagen 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/fornite.jpg') }}" alt="Imagen 2">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/diablo4.png') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/supersmashbros.png') }}" alt="Imagen 4">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/mario.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/valorant.jpg') }}" alt="Imagen 4">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/tft.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/juegos/mk1.jpg') }}" alt="Imagen 4">
                </div>

            </div>
        </div>
    </div>

    <aside class="ColaboladoresDelMain">
        <h2>Colaboramos con:</h2>
        <div class="ColaboladorMarca">
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/Activision.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/riotgames.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/play.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/nvidia.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/intel.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/logi.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/xbos.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/nintendo.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logo/steam.png') }}" alt="Imagen 1">
            </section>
        </div>
    </aside>

    <div id="app">
        <prueba></prueba>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            spaceBetween: 20,
            initialSlide: 3,
            loop: true, // Hace que el carrusel no tenga fin
            freeMode: true, // Movimiento suave y sin "saltos"
            speed: 5000, // Velocidad de desplazamiento más lenta
            coverflowEffect: {
                rotate: 10,
                stretch: 0,
                depth: 500,
                modifier: 1,
                slideShadows: true,
            },
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
        });
    });
</script>

@extends('Layouts.layouts')
@section('ContenidoPrincipalQueSeMuestra')
    <img src="{{ asset('image/Starcraft2.gif') }}" alt="my logo" class="IMGINDEX">

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
        <h2>Nuestro catalogo</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 2">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 4">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 4">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 3">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('image/fornite.jpg') }}" alt="Imagen 4">
                </div>

            </div>
        </div>
    </div>

    <aside class="ColaboladoresDelMain">
        <h2>Colaboramos con A </h2>
        <div class="ColaboladorMarca">
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/Activision.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/riotgames.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/play.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/nvidia.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/intel.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/logi.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/xbos.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/nintendo.png') }}" alt="Imagen 1">
            </section>
            <section class="ColaboladorMarcaImagen">
                <img src="{{ asset('image/steam.png') }}" alt="Imagen 1">
            </section>
        </div>
    </aside>

    <div id="app">
        <prueba></prueba> <!-- Aquí se usa el componente 'prueba' -->
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

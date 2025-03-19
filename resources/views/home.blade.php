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
        <div class="swiper-pagination"></div>
    </div>
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

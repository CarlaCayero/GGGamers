@extends('Layouts.layouts')
@section('ContenidoPrincipalQueSeMuestra')
<img src="{{ asset('image/nosotros/nosotros.gif') }}" alt="my logo" class="IMGINDEX">

    <div class="shadow-dance-container">
        <h1 class="shadow-dance-text">Equipo Good Game</h1>
    </div>
    <div class="ContenidoTexto">
        <p>Aquí no vienes solo a jugar, vienes a sentir la emoción de la competencia en vivo</p>
    </div>
@endsection
@section('ContenidoDelMainMaldicion')
<div class="n-contenido">
    <div class="desc p-5 m-5">
        <h1 class="n-h1-contenido n-color-secundario">Good Game</h1>
        <p class="n-p-contenido">
            Somos más que un simple local gaming;
            somos una <span class="n-p-contenido n-color-primario">comunidad donde la pasión por jugar se completa con la competición.</span>
        </p>
        <p class="n-p-contenido">
            Nuestro espacio está diseñado para que jugadores de todos los niveles,
            desde amateurs hasta profesionales, puedan <span class="n-p-contenido n-color-primario">disfrutar de una experiencia única,
            competir y hacer historia en cada partida.</span>
        </p>
    </div>
    <div class="n-local">
        <div class="n-carrousel">
            <div class="oferta p-5 m-5">
                <div class="carousel-container">
                    <div id="carousel" class="carousel n-h1-contenido n-color-primario">Un lugar seguro dónde pasarlo bien</div>
                </div>
            </div>
            <!-- Carrusel de imágenes -->
            <div class="image-carousel-container">
                <div id="imageCarousel" class="image-carousel">
                    <img src="{{ asset('image/nosotros/1.jpg') }}" alt="Imagen 1 de GG Gamers">
                    <img src="{{ asset('image/nosotros/2.jpg') }}" alt="Imagen 2 de GG Gamers">
                    <img src="{{ asset('image/nosotros/3.jpg') }}" alt="Imagen 3 de GG Gamers">
                    <img src="{{ asset('image/nosotros/4.jpg') }}" alt="Imagen 4 de GG Gamers">
                </div>
            </div>
        </div>
        <div class="n-mapa" id="app">
            <mapa></mapa>
        </div>
    </div>

</div>
@endsection

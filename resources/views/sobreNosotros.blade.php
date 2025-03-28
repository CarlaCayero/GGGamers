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

<div class="carousel">
    <div class="n-carousel">
        <div class="n-carousel-item">
            <img src="{{ asset('image/nosotros/1.jpg') }}" alt="Imagen 1">
        </div>
        <div class="n-carousel-item">
            <img src="{{ asset('image/nosotros/2.jpg') }}" alt="Imagen 2">
        </div>
        <div class="n-carousel-item">
            <img src="{{ asset('image/nosotros/3.jpg') }}" alt="Imagen 3">
        </div>
    </div>
</div>
@endsection

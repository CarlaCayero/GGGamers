@extends('Layouts.layouts')
@section('ContenidoPrincipalQueSeMuestra')
    <img src="{{ asset('image/logo/eventos.gif') }}" alt="my logo" class="IMGINDEX">
    <div class="shadow-dance-container">
        <h1 class="shadow-dance-text">{{ $juego->nombre }}</h1>
    </div>
    <div class="ContenidoTexto">
        <p>
            La diversión está garantizada! Participa y disfruta al máximo!
        </p>
    </div>
    @endsection
@section('ContenidoDelMainMaldicion')
<div id="app">
    <evento juego-id="{{ $juego->id_juego }}" :eventos="{{ json_encode($eventos)}}"></evento>
</div>
@endsection

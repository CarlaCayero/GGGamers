@extends('Layouts.layouts')
@section('ContenidoPrincipalQueSeMuestra')
    <img src="{{ asset('image/logo/gmae.gif') }}" alt="my logo" class="IMGINDEX">

    <div class="shadow-dance-container">
        <h1 class="shadow-dance-text">TORNEOS</h1>
    </div>
    <div class="ContenidoTexto">
        <p>
            El campo de batalla definitivo para los verdaderos jugadores.
        </p>
    </div>
@endsection

@section('ContenidoDelMainMaldicion')
    <div id="app" class="Fullwidth">
        <pagina-torneos></pagina-torneos>
    </div>
@endsection

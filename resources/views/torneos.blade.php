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
    <div id="app" class="row align-items-start">
        <div class="col-3">
            <pagina-torneos></pagina-torneos>
        </div>
        <div class="col-9">
            <pagina-torneos></pagina-torneos>
        </div>
    </div>
@endsection

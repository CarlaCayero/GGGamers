@extends('Layouts.layouts')
@section('ContenidoPrincipalQueSeMuestra')
    <img src="{{ asset('image/logo/eventos.gif') }}" alt="my logo" class="IMGINDEX">
    <div class="shadow-dance-container">
        <h1 class="shadow-dance-text">{{ strtoupper($juego) }} - EVENTOS</h1>
    </div>
    <div class="ContenidoTexto">
        <p>
            El campo de batalla definitivo para los verdaderos jugadores.
        </p>
    </div>
@endsection
@section('ContenidoDelMainMaldicion')
    <div class="eventos-lista">
        @if($eventos->isEmpty())
            <p>No hay eventos disponibles para {{ $juego }} en este momento.</p>
        @else
            @foreach($eventos as $participacion)
                <div class="evento-card">
                    <h2>{{ $participacion->evento->titulo }}</h2>
                    <p>{{ $participacion->evento->descripcion }}</p>
                    <p>{{ $participacion->evento->espacios_id_espacio }}
                </div>
            @endforeach
        @endif
    </div>
@endsection

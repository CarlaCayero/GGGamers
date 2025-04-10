@extends('Layouts.layouts')
@section('ContenidoPrincipalQueSeMuestra')
<img src="{{ asset('image/logo/home.gif') }}" alt="my logo" class="IMGINDEX">ç
<div class="shadow-dance-container">
    <h1 class="shadow-dance-text">{{ Auth::user()->nombre }}</h1>
</div>
<div class="ContenidoTexto">
    <p>
        Bienvenido a tu Perfil
    </p>
</div>
@endsection

@section('ContenidoDelMainMaldicion')
<div id="app" class="containerPerfil">
    <perfil :user-id='@json(Auth::user()->id_usuario)'></perfil>
</div>
@endsection


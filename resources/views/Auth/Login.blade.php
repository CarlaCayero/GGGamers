@extends('Layouts.layoutsAuth')

@section('titulo')
        <img src="{{ asset('image/logo.png') }}" alt="Logotipo" id="img-logo" >
        <h2 id="h2-titulo">INICIA SESIÓN</h2>

@endsection

@section('forms')
<div class="container">
    <div class="card">
        @include('partial.partial')
        <div class="card-body">
            <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'login']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="Username" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" id="UseName" name="UserName" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div>
                    <p class="p-auth">¿Aún no te has registrado? haz click <a class="a-auth" href="{{ url('register') }}">aquí</a></p>
                </div>

                <button type="submit" class="btn btn-inicio w-100">Iniciar Sesión</button>
            </form>
        </div>
    </div>
 </div>
@endsection

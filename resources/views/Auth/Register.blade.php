@extends('Layouts.layoutsAuth')
@section('imagen')
    <img src="{{ asset('image/registro.png') }}" alt="Imagen principal" id="img-authRegister">
@endsection

@section('titulo')
    <img src="{{ asset('image/logo.png') }}" alt="Logotipo" id="img-logo">
    <h2 id="h2-titulo">REGÍSTRATE</h2>
@endsection

@section('forms')
<div class="container">
    <div class="card">
        @include('partial.partial')
        <div class="card-body">
            <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'store']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control"  id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Correo electónico</label>
                    <input type="email" class="form-control" id="mail" name="mail" required>
                </div>
                <div class="mb-3">
                    <label for="contrasenya" class="form-label">Contraseña</label>
                    <input type="password" class="form-control"  id="contrasenya" name="contrasenya" required>
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control"  id="edad" name="edad" required>
                </div>
                <input type="hidden" name="roles_id_rol" value="1">
                <button type="submit" class="btn btn-register w-100">Registrarse</button>
            </form>
        </div>
    </div>
 </div>
@endsection


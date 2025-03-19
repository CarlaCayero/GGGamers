@extends('Layouts.layoutsAuth')
@section('Contenido')
<div class="container">
    <div class="card">
        <h2>Iniciar Sesion</h2>
        @include('partial.partial')
        <div class="card-body">
            <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'login']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="Username" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="UseName" name="UserName" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>
        </div>
    </div>
 </div>
@endsection

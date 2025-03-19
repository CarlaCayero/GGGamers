@extends('Layouts.layoutsAuth')

@section('Contenido')
<div class="container">
    <div class="card">
        <h2>Registro de Usuario</h2>
        @include('partial.partial')
        <div class="card-body">
            <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'store']) }}" method="POST">
                @csrf
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <br>

                <label for="mail">Correo:</label>
                <input type="email" id="mail" name="mail" required>
                <br>

                <label for="contrasenya">Contraseña:</label>
                <input type="password" id="contrasenya" name="contrasenya" required>
                <br>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required>
                <br>

                <input type="hidden" name="roles_id_rol" value="1">

                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
 </div>
@endsection


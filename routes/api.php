<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\JuegoController;
use App\Http\Controllers\Api\EventoController;
use App\Http\Controllers\Api\EspacioController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ParticiparController;
use App\Http\Controllers\Api\PlataformaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('espacios', EspacioController::class);
Route::apiResource('eventos', EventoController::class);
Route::apiResource('juegos', JuegoController::class);
Route::apiResource('usuarios_has_eventos', ParticiparController::class);
Route::apiResource('plataformas', PlataformaController::class);
Route::apiResource('roles', RolController::class);
Route::apiResource('usuarios', UsuarioController::class);




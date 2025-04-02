<?php

use App\Http\Controllers\Api\JuegoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/torneos', function () {
    return view('torneos');
});
Route::get('/login', [UsuarioController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsuarioController::class, 'login'])->name('login.submit');

// Rutas de registro
Route::get('/register', [UsuarioController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UsuarioController::class, 'store'])->name('register.store');

Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

Route::get('/profile/{id_usuario}', function($id_usuario) {
    $user = App\Models\Usuario::where('id_usuario', $id_usuario)->first();
    return view('MyProfile', compact('user'));
})->name('Profile');

Route::get('/torneos', function() {
    return view('torneos');
});
Route::get('/sobre-nosotros', function() {
    return view('sobreNosotros');
});



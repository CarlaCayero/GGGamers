<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{

    public function showLoginForm()
    {
        return view("auth.Login");
    }

    public function showRegisterForm()
    {
        return view("auth.register");
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear una nueva instancia de Usuario
        $usuario = new Usuario();

        // Asignar los valores del formulario a las propiedades del modelo
        $usuario->nombre = $request->input('nombre');
        $usuario->mail = $request->input('mail');
        $usuario->contrasenya = Hash::make($request->input('contrasenya'));
        $usuario->edad = $request->input('edad');
        $usuario->roles_id_rol = $request->input('roles_id_rol');  // El valor que viene del campo oculto

        try {
            // Guardar el usuario en la base de datos
            $usuario->save();
            // Enviar mensaje de éxito
            $request->session()->flash('success', 'Usuario registrado con éxito.');

            // Redirigir al login (o donde desees)
            return redirect()->route('login');
        } catch (QueryException $ex) {
            // Capturar cualquier error al guardar
            $mensaje = Utilidad::errorMensaje($ex);

            // Enviar mensaje de error
            $request->session()->flash('error', $mensaje);

            // Redirigir a la página de registro y mantener los valores previos
            return redirect()->route('register')->withInput();
        }
    }


    // public function login(Request $request)
    // {
    //     $Usuario = $request->input('UserName');
    //     $contrasena = $request->input('password');

    //     // Buscar el usuario por el nombre
    //     $usuario = Usuario::where('nombre', $Usuario)->first();

    //     if ($usuario != null && Hash::check($contrasena, $usuario->contrasenya)) {
    //         Auth::login($usuario);

    //         // Redirigir al usuario a la página de inicio (puedes cambiar la ruta de destino)
    //         $response = redirect('/');
    //     } else {
    //         // Si el usuario no existe o la contraseña es incorrecta
    //         $mensaje = Utilidad::errorMensaje($ex);
    //         $request->session()->flash('error', );
    //         $response = redirect()->action([UsuarioController::class, 'showLoginForm'])->withInput();
    //     }

    //     return $response;
    // }

    public function login(Request $request)
    {
        try {
            $Usuario = $request->input('UserName');
            $contrasena = $request->input('password');

            // Buscar el usuario por el nombre
            $usuario = Usuario::where('nombre', $Usuario)->firstOrFail(); // Usamos firstOrFail para lanzar una excepción si no se encuentra

            // Iniciar sesión del usuario
            Auth::login($usuario);

            // Redirigir al usuario a la página de inicio
            $response = redirect('/torneos');
        } catch (\Exception $ex) {
            // Si ocurre una excepción, mostrar mensaje de error y redirigir a la página de inicio de sesión
            $mensaje = Utilidad::errorMensaje($ex);
            $request->session()->flash('error', $mensaje);
            $response = redirect()->action([UsuarioController::class, 'showLoginForm'])->withInput();
        }

        return $response;
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        // Invalida la sesión actual del usuario.
        // Al llamar a 'invalidate()', estamos eliminando todos los datos asociados con la sesión
        // en el servidor, como el ID del usuario y cualquier otro dato temporal guardado. Esto
        // asegura que el usuario no pueda seguir interactuando con la aplicación bajo el contexto
        // de la sesión cerrada. Es fundamental para evitar que cualquier dato sensible, como la
        // identidad del usuario o su estado de autenticación, persista una vez que el usuario haya
        // decidido cerrar sesión o cuando se detecte un intento de acceso no autorizado.

        $request->session()->regenerateToken();

        // Regenera el token CSRF para la sesión.
        // El token CSRF es un mecanismo de protección que previene los ataques de tipo
        // Cross-Site Request Forgery. Cada vez que un usuario realiza una acción en una aplicación
        // (como enviar un formulario), se debe enviar un token CSRF para verificar que la solicitud
        // proviene de un origen legítimo. Al regenerar el token, nos aseguramos de que el antiguo
        // token CSRF ya no sea válido, protegiendo así al usuario de posibles ataques en los que
        // un atacante intente ejecutar solicitudes maliciosas con el token de una sesión anterior.
        // Este paso es importante como parte del proceso de cierre de sesión, ya que asegura que
        // la sesión comprometida no pueda ser utilizada por un atacante para realizar acciones no autorizadas.

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}

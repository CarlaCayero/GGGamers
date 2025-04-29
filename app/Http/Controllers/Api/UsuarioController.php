<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UsuarioResource;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Usuario::query();

        if ($request->has('id_usuario') && $request->id_usuario != '') {
            $query->where('id_usuario', $request->id_usuario);
        }

        $usuarios = $query->with('rol', 'eventos.juego')->get();

        return UsuarioResource::collection($usuarios);
    }

    public function update(Request $request, Usuario $usuario)
    {
        $usuario->nombre = $request->input('nombre');
        $usuario->mail = $request->input('mail');
        $usuario->edad = $request->input('edad');

        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $file->storeAs('', $file->getClientOriginalName(), 'public');
            $usuario->ImagenRuta = 'media/' . $file->getClientOriginalName();
        }

        try {
            $usuario->save();
            return response()->json($usuario, 200);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            return response()->json(["error" => $mensaje], 400);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuarios = new Usuario();
        $usuarios->nombre = $request->input('nombre');
        $usuarios->mail = $request->input('mail');
        $usuarios->contrasenya = $request->input('contrasenya');
        $usuarios->edad = $request->input('edad');
        $usuarios->roles_id_rol = $request->input('roles_id_rol');


        try {
            $usuarios->save();
            $response = (new UsuarioResource($usuarios))->response()->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario, Request $request)
    {
        try {
            $usuario->delete();

            // Si el usuario que se está eliminando es el mismo que está autenticado
            if (Auth::id() === $usuario->id_usuario) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return response()->json(['mensaje' => 'Usuario eliminado y sesión cerrada'], 200);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            return response()->json(["error" => $mensaje], 400);
        }
    }

}

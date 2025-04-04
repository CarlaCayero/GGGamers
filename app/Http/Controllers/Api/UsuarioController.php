<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResource;
use App\Clases\Utilidad;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Usuario::query();

        // Corregir la comprobación del parámetro y usar 'id_usuario' en lugar de 'usuarios'
        if ($request->has('id_usuario') && $request->id_usuario != '') {
            $query->where('id_usuario', $request->id_usuario);
        }

        $usuarios = $query->with('rol')->get();

        return UsuarioResource::collection($usuarios);
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
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario->nombre = $request->input('nombre');
        $usuario->mail = $request->input('mail');
        $usuario->contrasenya = $request->input('contrasenya');
        $usuario->edad = $request->input('edad');
        $usuario->roles_id_rol = $request->input('roles_id_rol');
        try {
            $usuario->save();
            return (new UsuarioController($usuario))->response()->setStatusCode(200);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            return response()->json(["error" => $mensaje], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        try{
            $usuario->delete();
            $response = \response()->json(['misatge' => 'Registro esborrat correctamente'], 200);
        }
        catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Participar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParticiparResource;
use App\Clases\Utilidad;
use Illuminate\Database\QueryException;

class ParticiparController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participantes = Participar::all();
        return ParticiparResource::collection($participantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $participantes = new Participar();
        $participantes->usuarios_id_usuario = $request->input('usuarios_id_usuario');
        $participantes->eventos_id_evento = $request->input('eventos_id_evento');
        $participantes->juegos_id_juego = $request->input('juegos_id_juego');
        $participantes->fecha = $request->input('fecha');
        $participantes->hora_inicio = $request->input('hora_inicio');
        $participantes->hora_fin = $request->input('hora_fin');
        $participantes->posicion = $request->input('posicion');

        try {
            $participantes->save();
            $response = (new ParticiparResource($participantes))->response()->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Participar $participar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participar $participar)
    {
        $participar->usuarios_id_usuario = $request->input('usuarios_id_usuario');
        $participar->eventos_id_evento = $request->input('eventos_id_evento');
        $participar->juegos_id_juego = $request->input('juegos_id_juego');
        $participar->fecha = $request->input('fecha');
        $participar->hora_inicio = $request->input('hora_inicio');
        $participar->hora_fin = $request->input('hora_fin');
        $participar->posicion = $request->input('posicion');
        try {
            $participar->save();
            return (new ParticiparResource($participar))->response()->setStatusCode(200);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            return response()->json(["error" => $mensaje], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participar $participar)
    {
        try{
            $participar->delete();
            $response = \response()->json(['misatge' => 'Registro esborrat correctamente'], 200);
        }
        catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }
}

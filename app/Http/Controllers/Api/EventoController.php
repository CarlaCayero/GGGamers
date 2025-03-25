<?php

namespace App\Http\Controllers\Api;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventoResource;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::all();
        return EventoResource::collection($eventos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $eventos = new Evento();
        $eventos->nombre = $request->input('nombre');
        $eventos->descripcion = $request->input('descripcion');
        $eventos->espacios_id_espacio = $request->input('espacios_id_espacio');

        try {
            $eventos->save();
            $response = (new EventoResource($eventos))->response()->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        try{
            $evento->delete();
            $response = \response()->json(['misatge' => 'Registro esborrat correctamente'], 200);
        }
        catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }
}

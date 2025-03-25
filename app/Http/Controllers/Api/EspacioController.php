<?php

namespace App\Http\Controllers\Api;

use App\Models\Espacio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EspacioResource;

class EspacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espacios = Espacio::all();
        return EspacioResource::collection($espacios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $espacios = new Espacio();
        $espacios->nombre = $request->input('nombre');

        try {
            $espacios->save();
            $response = (new EspacioResource($espacios))->response()->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Espacio $espacio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Espacio $espacio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espacio $espacio)
    {
        try{
            $espacio->delete();
            $response = \response()->json(['misatge' => 'Registro esborrat correctamente'], 200);
        }
        catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }
}

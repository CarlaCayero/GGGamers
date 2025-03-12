<?php

namespace App\Http\Controllers\Api;

use App\Models\Juego;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JuegoResource;
use Illuminate\Database\QueryException;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juegos = Juego::all();
        return JuegoResource::collection($juegos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $juegos = new Juego();
        $juegos->nombre = $request->input('nombre');
        $juegos->pegi = $request->input('pegi');

        try {

            $juegos->save();
            // $request->session()->flash('success', 'Cicle creado con éxito.'); no sirver en una API
            $response = (new JuegoResource($juegos))->response()->setStatusCode(201);
        } catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            // $request->session()->flash('error', $mensaje);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Juego $juegos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juegos)
    {
        $juegos->nombre = $request->input('nombre');
        $juegos->pegi = $request->input('pegi');
        try {
            $juegos->save();
            // $request->session()->flash('success', 'Cicle creado con éxito.'); no sirver en una API
            $response = (new JuegoResource($juegos))->response()->setStatusCode(201);
        } catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            // $request->session()->flash('error', $mensaje);
            $response = \response()->json(["error" => $mensaje],400);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juego $juegos)
    {
        try{
            $juegos->delete();
            $response = \response()->json(['misatge' => 'Registro esborrat correctamente'], 200);
        }
        catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }
}

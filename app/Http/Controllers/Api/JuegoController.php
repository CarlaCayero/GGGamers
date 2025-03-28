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
    public function index(Request $request)
    {
        $query = Juego::query();

        // Filtro por nombre de juego
        if ($request->has('juego') && $request->juego != '') {
            $query->where('nombre', 'like', '%' . $request->juego . '%');
        }

        // Filtro por PEGI
        if ($request->has('pegi') && $request->pegi != '') {
            $query->where('pegi', $request->pegi);
        }

        if ($request->has('categoria') && $request->input('categoria') != '') {
            $query->whereHas('categorias', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('categoria') . '%');
            });
        }
        if ($request->has('plataforma') && $request->input('plataforma') != '') {
            $query->whereHas('plataformas', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('plataforma') . '%');
            });
        }

        // Obtener los juegos filtrados
        $juegos = $query->get();

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
    public function show(Juego $juego)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juego)
    {
        $juego->nombre = $request->input('nombre');
        $juego->pegi = $request->input('pegi');
        try {
            $juego->save();
            return (new JuegoResource($juego))->response()->setStatusCode(200);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            return response()->json(["error" => $mensaje], 400);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juego $juego)
    {
        try {
            $juego->delete();
            return response()->json(['mensaje' => 'Registro eliminado correctamente'], 200);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            return response()->json(["error" => $mensaje], 400);
        }
    }

}

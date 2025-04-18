<?php

namespace App\Http\Controllers\Api;

use App\Models\Plataforma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlataformaResource;
use App\Clases\Utilidad;
use Illuminate\Database\QueryException;

class PlataformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plataformas = Plataforma::all();
        return PlataformaResource::collection($plataformas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $plataformas = new Plataforma();
        $plataformas->nombre = $request->input('nombre');


        try {
            $plataformas->save();
            $response = (new PlataformaResource($plataformas))->response()->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Plataforma $plataforma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plataforma $plataforma)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plataforma $plataforma)
    {
        try{
            $plataforma->delete();
            $response = \response()->json(['misatge' => 'Registro esborrat correctamente'], 200);
        }
        catch (QueryException $ex) {

            $mensaje = Utilidad::errorMensaje($ex);
            $response = \response()->json(["error" => $mensaje],400);
        }

        return $response;
    }
}

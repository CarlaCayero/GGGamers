<?php

namespace App\Http\Controllers\Api;

use App\Models\Plataforma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlataformaResource;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plataforma $plataforma)
    {
        //
    }
}

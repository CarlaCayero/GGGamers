<?php

namespace App\Http\Controllers\Api;

use App\Models\Juego;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JuegoResource;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Juego $juego)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juego)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juego $juego)
    {
        //
    }
}

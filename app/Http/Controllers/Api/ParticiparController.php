<?php

namespace App\Http\Controllers\Api;

use App\Models\Participar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParticiparResource;

class ParticiparController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participarntes = Participar::all();
        return ParticiparResource::collection($participarntes);
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
    public function show(Participar $participar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participar $participar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participar $participar)
    {
        //
    }
}

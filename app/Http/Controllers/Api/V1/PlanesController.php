<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Planes;
use Illuminate\Http\Request;
use App\Http\Resources\V1\PlanResource;
use App\Http\Resources\V1\PlanCollection;

class PlanesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new PlanCollection(Planes::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'preci' => 'required|numeric',
            'cupones' => 'nullable|array'
        ]);

        // Nuevo plan
        $plan = Planes::create($validatedData);

        // Retornar el plan creado
        return new PlanResource($plan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function show(Planes $planes)
    {
        //
        return new PlanResource($planes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planes $planes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planes $planes)
    {
        //
    }
}

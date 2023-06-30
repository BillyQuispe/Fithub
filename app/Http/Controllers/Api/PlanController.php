<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;


class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $planes = Plan::all();
    return response()->json(['data' => $planes], JsonResponse::HTTP_OK);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos requeridos
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'sessions' => 'required',
        ]);
    
        // Crear un nuevo plan
        $plan = new Plan();
        $plan->nombre = $request->nombre;
        $plan->precio = $request->precio;
        $plan->sessions = $request->sessions;
        $plan->save();
    
        // Devolver una respuesta JSON con el mensaje exitoso
        return response()->json(['message' => 'Plan creado exitosamente'], JsonResponse::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $plan = Plan::find($id);
    if (!$plan) {
        return response()->json(['message' => 'Plan no encontrado'], JsonResponse::HTTP_NOT_FOUND);
    }
    return response()->json(['data' => $plan], JsonResponse::HTTP_OK);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $plan = Plan::find($id);
    if (!$plan) {
        return response()->json(['message' => 'Plan no encontrado'], JsonResponse::HTTP_NOT_FOUND);
    }

    // Validar los campos requeridos
    $request->validate([
        'nombre' => 'required',
        'precio' => 'required',
        'sessions' => 'required',
    ]);

    $plan->nombre = $request->nombre;
    $plan->precio = $request->precio;
    $plan->sessions = $request->sessions;
    $plan->save();

    return response()->json(['message' => 'Plan actualizado exitosamente'], JsonResponse::HTTP_OK);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $plan = Plan::find($id);
    if (!$plan) {
        return response()->json(['message' => 'Plan no encontrado'], JsonResponse::HTTP_NOT_FOUND);
    }

    $plan->delete();

    return response()->json(['message' => 'Plan eliminado exitosamente'], JsonResponse::HTTP_OK);
}
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Planes;
use Illuminate\Http\Request;
use App\Http\Resources\V1\PlanResource;
use App\Http\Resources\V1\PlanCollection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

class PlanesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planes = Planes::all();

        if ($planes->isEmpty()) {
            return response()->json([
                "status" => 400,
                "message" => "No se encontraron planes en la base de datos.",
            ], 400);
        }

        return response()->json([
            "status" => 200,
            "message" => "Se encontraron " . $planes->count() . " planes en la base de datos.",
            "data" => $planes
        ]);
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
        $validatedData =  Validator::make($request->all(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'preci' => 'required',
            'cupones' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => "Datos inválidos",
                'error' => $validatedData->errors(),
            ], 400);
        }

        // Nuevo plan
        $plan = Planes::create([
            'name' => $request->input("name"),
            'description' => $request->input("description"),
            'preci' => $request->input("preci"),
            'cupones' => $request->input("cupones")
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Plan creado exitosamente',
            'data' => $plan
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $mostrarplan = Planes::where('name', $name)->get();

        if ($mostrarplan->isEmpty()) {
            return response()->json([
                "status" => 400,
                "message" => "No se encontró el plan",
                "data" => []
            ], 400);
        }

        return response()->json([
            "status" => 200,
            "message" => "Se encontró el plan",
            "data" => $mostrarplan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = Planes::find($id);

        if (!$plan) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontró el plan',
            ], 400);
        }

        $plan->name = $request->input('name');
        $plan->description = $request->input('description');
        $plan->preci = $request->input('preci');
        $plan->cupones = $request->input('cupones');
        $plan->save();

        return response()->json([
            'status' => 200,
            'message' => 'Plan actualizado exitosamente',
            'data' => $plan,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planes  $planes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Planes::find($id);

        if (!$plan) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontró el plan',
            ], 400);
        }

        $plan->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Plan eliminado correctamente',
        ], 200);
    }
}

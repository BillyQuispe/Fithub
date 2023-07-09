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
        //
        $planes = Planes::all();
        if ($planes) {
            $cantidad = $planes->count();
            return response()->json([
                "status" => 200,
                "message" => "Se han encontrado $cantidad PLanes",
                "data" => $planes
            ]);
        } else {
            return response()->json([
                "status" => 400,
                "message" => "No se encontro Planes"
            ], 400);
        }
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
                'message' => "Datos Invalidos",
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
            'message' => 'Plan creado!',
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
    // Buscar el plan por su nombre
    $mostrarplan = Planes::where('name', $name)->get();

    // Verificar si se encontró el plan
    if ($mostrarplan->isNotEmpty()) {
        $cantidad = $mostrarplan->count();

        return response()->json([
            "status" => 200,
            "message" => "Se han encontrado $cantidad planes",
            "data" => $mostrarplan
        ]);
    } else {
        return response()->json([
            "status" => 400,
            "message" => "No existe plan",
            "data" => []
        ], 400);
    }
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
    public function destroy($id)
{
    // Buscar el plan por su id
    $plan = Planes::find($id);

    if ($plan) {
        // Eliminar el plan
        $plan->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Plan eliminado correctamente',
        ], 200);
    } else {
        return response()->json([
            'status' => 400,
            'message' => 'Plan no encontrado',
        ], 400);
    }
}

}

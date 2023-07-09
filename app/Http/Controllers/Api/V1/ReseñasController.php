<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Reseñas;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ReseñaResource;
use App\Http\Resources\V1\ReseñaCollection;
use Illuminate\Support\Facades\Validator;

class ReseñasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todas las reseñas
        $reseñas = Reseñas::all();

        if ($reseñas->isEmpty()) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontraron reseñas',
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Se han encontrado reseñas',
            'data' => $reseñas,
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
        $validatedData = Validator::make($request->all(), [
            'n_estrellas' => 'required|integer',
            'description' => 'required|string',
            'rol_id' => 'required|exists:roles,id',
            'gym_id' => 'required|exists:gimnasios,id',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        // Crear una nueva reseña
        $reseña = Reseñas::create([
            'n_estrellas' => $request->input('n_estrellas'),
            'description' => $request->input('description'),
            'rol_id' => $request->input('rol_id'),
            'gym_id' => $request->input('gym_id'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Reseña creada exitosamente',
            'data' => $reseña,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Buscar la reseña por su ID
        $reseña = Reseñas::find($id);

        // Verificar si se encontró la reseña
        if ($reseña) {
            return response()->json([
                'status' => 200,
                'message' => 'Reseña encontrada',
                'data' => $reseña,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Reseña no encontrada',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $validatedData = Validator::make($request->all(), [
            'n_estrellas' => 'integer',
            'description' => 'string',
            'rol_id' => 'exists:roles,id',
            'gym_id' => 'exists:gimnasios,id',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        // Buscar la reseña por su ID
        $reseña = Reseñas::find($id);

        // Verificar si se encontró la reseña
        if ($reseña) {
            // Actualizar la reseña con los nuevos datos
            if ($request->filled('n_estrellas')) {
                $reseña->n_estrellas = $request->input('n_estrellas');
            }
            if ($request->filled('description')) {
                $reseña->description = $request->input('description');
            }
            if ($request->filled('rol_id')) {
                $reseña->rol_id = $request->input('rol_id');
            }
            if ($request->filled('gym_id')) {
                $reseña->gym_id = $request->input('gym_id');
            }
            $reseña->save();

            return response()->json([
                'status' => 200,
                'message' => 'Reseña actualizada exitosamente',
                'data' => $reseña,
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Reseña no encontrada',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar la reseña por su ID
        $reseña = Reseñas::find($id);

        // Verificar si se encontró la reseña
        if ($reseña) {
            // Eliminar la reseña
            $reseña->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Reseña eliminada correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Reseña no encontrada',
            ], 400);
        }
    }
}

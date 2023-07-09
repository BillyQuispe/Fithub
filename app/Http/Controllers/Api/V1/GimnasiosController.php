<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Gimnasios;
use Illuminate\Http\Request;
use App\Http\Resources\V1\GimnasioResource;
use App\Http\Resources\V1\GimnasioCollection;

class GimnasiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all the existing gyms from the database
        $gyms = Gimnasios::all();

        if ($gyms->isEmpty()) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontraron gimnasios',
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Se han encontrado gimnasios',
            'data' => $gyms,
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
        // Validate the input data
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'logo' => 'required|image',
            'geolocalizacion' => 'required|string',
            'ruc' => 'required|string',
            'aforo' => 'required|integer',
            'horarios_atencion' => 'required|string',
        ]);

        // Save the uploaded image
        $logoPath = $request->file('logo')->move('images', $request->file('logo')->getClientOriginalName());

        // Create a new gym
        $gym = Gimnasios::create([
            'nombre' => $validatedData['nombre'],
            'logo' => $logoPath,
            'geolocalizacion' => $validatedData['geolocalizacion'],
            'ruc' => $validatedData['ruc'],
            'aforo' => $validatedData['aforo'],
            'horarios_atencion' => $validatedData['horarios_atencion'],
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio creado exitosamente',
            'data' => $gym,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gimnasios  $gimnasios
     * @return \Illuminate\Http\Response
     */
    public function show(Gimnasios $gimnasios)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio encontrado',
            'data' => $gimnasios,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gimnasios  $gimnasios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gimnasios $gimnasios)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nombre' => 'string',
            'logo' => 'image',
            'geolocalizacion' => 'string',
            'ruc' => 'string',
            'aforo' => 'integer',
            'horarios_atencion' => 'string',
        ]);

        // Update the gym's fields if provided
        if ($request->filled('nombre')) {
            $gimnasios->nombre = $validatedData['nombre'];
        }
        if ($request->hasFile('logo')) {
            // Delete the previous logo
            if (file_exists(public_path($gimnasios->logo))) {
                unlink(public_path($gimnasios->logo));
            }

            // Save the new logo image
            $logoPath = $request->file('logo')->move('images', $request->file('logo')->getClientOriginalName());
            $gimnasios->logo = $logoPath;
        }
        if ($request->filled('geolocalizacion')) {
            $gimnasios->geolocalizacion = $validatedData['geolocalizacion'];
        }
        if ($request->filled('ruc')) {
            $gimnasios->ruc = $validatedData['ruc'];
        }
        if ($request->filled('aforo')) {
            $gimnasios->aforo = $validatedData['aforo'];
        }
        if ($request->filled('horarios_atencion')) {
            $gimnasios->horarios_atencion = $validatedData['horarios_atencion'];
        }

        // Save the updated gym
        $gimnasios->save();

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio actualizado exitosamente',
            'data' => $gimnasios,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gimnasios  $gimnasios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gimnasios $gimnasios)
    {
        // Delete the gym's logo
        if (file_exists(public_path($gimnasios->logo))) {
            unlink(public_path($gimnasios->logo));
        }

        // Delete the gym from the database
        $gimnasios->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio eliminado exitosamente',
        ],200);
    }
}

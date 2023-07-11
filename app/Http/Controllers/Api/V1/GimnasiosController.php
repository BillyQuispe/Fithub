<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Gimnasios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GimnasiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $gimnasios = Gimnasios::all();



        return response()->json([
            'status' => 200,
            'message' => 'Se encontraron ' . $gimnasios->count() . ' gimnasios en la base de datos.',
            'data' => $gimnasios,
=======
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
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
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
<<<<<<< HEAD
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|string',
=======
        // Validate the input data
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'logo' => 'required|image',
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
            'geolocalizacion' => 'required|string',
            'ruc' => 'required|string',
            'aforo' => 'required|integer',
            'horarios_atencion' => 'required|string',
        ]);

<<<<<<< HEAD
        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        $gimnasio = Gimnasios::create([
            'nombre' => $request->input('nombre'),
            'geolocalizacion' => $request->input('geolocalizacion'),
            'ruc' => $request->input('ruc'),
            'aforo' => $request->input('aforo'),
            'horarios_atencion' => $request->input('horarios_atencion'),
=======
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
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio creado exitosamente',
<<<<<<< HEAD
            'data' => $gimnasio,
=======
            'data' => $gym,
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
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
<<<<<<< HEAD
        $gimnasio = Gimnasios::find($id);

        if (!$gimnasio) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontró el gimnasio',
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Se encontró el gimnasio',
            'data' => $gimnasio,
=======
        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio encontrado',
            'data' => $gimnasios,
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
        ]);
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
<<<<<<< HEAD
        $gimnasio = Gimnasios::find($id);

        if (!$gimnasio) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontró el gimnasio',
            ], 400);
        }

        $validatedData = Validator::make($request->all(), [
            'nombre' => 'string',
=======
        // Validate the input data
        $validatedData = $request->validate([
            'nombre' => 'string',
            'logo' => 'image',
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
            'geolocalizacion' => 'string',
            'ruc' => 'string',
            'aforo' => 'integer',
            'horarios_atencion' => 'string',
        ]);

<<<<<<< HEAD
        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        if ($request->filled('nombre')) {
            $gimnasio->nombre = $request->input('nombre');
        }
        if ($request->filled('geolocalizacion')) {
            $gimnasio->geolocalizacion = $request->input('geolocalizacion');
        }
        if ($request->filled('ruc')) {
            $gimnasio->ruc = $request->input('ruc');
        }
        if ($request->filled('aforo')) {
            $gimnasio->aforo = $request->input('aforo');
        }
        if ($request->filled('horarios_atencion')) {
            $gimnasio->horarios_atencion = $request->input('horarios_atencion');
        }

        $gimnasio->save();
=======
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
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio actualizado exitosamente',
<<<<<<< HEAD
            'data' => $gimnasio,
=======
            'data' => $gimnasios,
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        $gimnasio = Gimnasios::find($id);

        if (!$gimnasio) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontró el gimnasio',
            ], 400);
        }

        $gimnasio->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio eliminado correctamente',
        ], 200);
=======
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
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
    }
}
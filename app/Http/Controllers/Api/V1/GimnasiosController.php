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
        $gimnasios = Gimnasios::all();



        return response()->json([
            'status' => 200,
            'message' => 'Se encontraron ' . $gimnasios->count() . ' gimnasios en la base de datos.',
            'data' => $gimnasios,
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
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'geolocalizacion' => 'required|string',
            'ruc' => 'required|string',
            'aforo' => 'required|integer',
            'horarios_atencion' => 'required|string',
        ]);

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
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio creado exitosamente',
            'data' => $gimnasio,
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
        $gimnasio = Gimnasios::find($id);

        if (!$gimnasio) {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontró el gimnasio',
            ], 400);
        }

        $validatedData = Validator::make($request->all(), [
            'nombre' => 'string',
            'geolocalizacion' => 'string',
            'ruc' => 'string',
            'aforo' => 'integer',
            'horarios_atencion' => 'string',
        ]);

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

        return response()->json([
            'status' => 200,
            'message' => 'Gimnasio actualizado exitosamente',
            'data' => $gimnasio,
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
    }
}
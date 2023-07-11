<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = Usuarios::all();

        return response()->json([
            'status' => 200,
            'message' => 'Usuarios encontrados',
            'data' => $usuarios
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
            'nombre' => 'required|string',
            'asistencia' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        // Crear un nuevo usuario
        $usuario = Usuarios::create([
            'nombre' => $request->input('nombre'),
            'asistencia' => $request->input('asistencia'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Usuario creado exitosamente',
            'data' => $usuario,
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
        // Buscar el usuario por su ID
        $usuario = Usuarios::find($id);

        // Verificar si se encontró el usuario
        if ($usuario) {
            return response()->json([
                'status' => 200,
                'message' => 'Usuario encontrado',
                'data' => $usuario,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Usuario no encontrado',
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
            'nombre' => 'required|string',
            'asistencia' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        // Buscar el usuario por su ID
        $usuario = Usuarios::find($id);

        // Verificar si se encontró el usuario
        if ($usuario) {
            // Actualizar el usuario con los nuevos datos
            $usuario->nombre = $request->input('nombre');
            $usuario->asistencia = $request->input('asistencia');
            $usuario->save();

            return response()->json([
                'status' => 200,
                'message' => 'Usuario actualizado exitosamente',
                'data' => $usuario,
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Usuario no encontrado',
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
        // Buscar el usuario por su ID
        $usuario = Usuarios::find($id);

        // Verificar si se encontró el usuario
        if ($usuario) {
            // Eliminar el usuario
            $usuario->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Usuario eliminado correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Usuario no encontrado',
            ], 400);
        }
    }
}

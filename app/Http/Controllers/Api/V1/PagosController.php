<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use App\Models\usuarios;
use Illuminate\Http\Request;
use App\Http\Resources\V1\PagoResource;
use App\Http\Resources\V1\PagoCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los pagos
        $pagos = Pagos::all();
        
        // Verificar si se encontraron pagos
        if ($pagos->isNotEmpty()) {
            $cantidad = $pagos->count();
            
            return response()->json([
                'status' => 200,
                'message' => "Se han encontrado $cantidad pagos",
                'data' => $pagos
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'No se encontraron pagos',
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
    $validatedData = Validator::make($request->all(), [
        'id_usuario' => 'required',
        'foto' => 'required|file|mimes:jpg,png,gif,pdf|max:3000',
    ]);

    if ($validatedData->fails()) {
        return response()->json([
            'status' => 400,
            'message' => 'Datos inválidos',
            'error' => $validatedData->errors(),
        ], 400);
    }

    // Obtener el usuario por su id
    $usuario = usuarios::find($request->input('id_usuario'));

    if (!$usuario) {
        return response()->json([
            'status' => 400,
            'message' => 'Usuario no encontrado',
        ], 400);
    }

    // Subir la imagen y guardar la URL en la base de datos
    //$path = $request->file('foto')->store('voucher');
     // Subir la imagen y obtener la ruta del archivo
  
  

     // Crear un nuevo pago
     $pago = new Pagos();
     $pago->id_usuario = $usuario->id;
     $pago->foto = $request->file('foto')->storage('voucher');
     $pago->save();

    return response()->json([
        'status' => 200,
        'message' => 'Pago creado exitosamente',
        'data' => $pago,
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
        // Buscar el pago por su ID
        $pago = Pagos::find($id);

        // Verificar si se encontró el pago
        if ($pago) {
            // Eliminar el pago
            $pago->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Pago eliminado correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Pago no encontrado',
            ], 400);
        }
    }
};
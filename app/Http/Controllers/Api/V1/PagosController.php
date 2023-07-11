<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use App\Models\usuarios;
use Illuminate\Http\Request;
use App\Http\Resources\V1\PagoResource;
use App\Http\Resources\V1\PagoCollection;
use Illuminate\Support\Facades\Validator;
<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;

=======
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880

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
<<<<<<< HEAD
   /**
=======

    /**
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
<<<<<<< HEAD
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
=======
    {
        // Validar los datos de entrada
        $validatedData = Validator::make($request->all(), [
            'cod_usuario' => 'required',
            'fecha' => 'required|date',
            'nro_operacion' => 'required',
            'monto' => 'required',
            'estado' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        // Crear un nuevo pago
        $pago = Pagos::create([
            'cod_usuario' => $request->input('cod_usuario'),
            'fecha' => $request->input('fecha'),
            'nro_operacion' => $request->input('nro_operacion'),
            'monto' => $request->input('monto'),
            'estado' => $request->input('estado'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Pago creado exitosamente',
            'data' => $pago,
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
        // Buscar el pago por su ID
        $pago = Pagos::find($id);

        // Verificar si se encontró el pago
        if ($pago) {
            return response()->json([
                'status' => 200,
                'message' => 'Pago encontrado',
                'data' => $pago,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Pago no encontrado',
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
            'cod_usuario' => 'required',
            'fecha' => 'required|date',
            'nro_operacion' => 'required',
            'monto' => 'required',
            'estado' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Datos inválidos',
                'error' => $validatedData->errors(),
            ], 400);
        }

        // Buscar el pago por su ID
        $pago = Pagos::find($id);

        // Verificar si se encontró el pago
        if ($pago) {
            // Actualizar el pago con los nuevos datos
            $pago->cod_usuario = $request->input('cod_usuario');
            $pago->fecha = $request->input('fecha');
            $pago->nro_operacion = $request->input('nro_operacion');
            $pago->monto = $request->input('monto');
            $pago->estado = $request->input('estado');
            $pago->save();

            return response()->json([
                'status' => 200,
                'message' => 'Pago actualizado exitosamente',
                'data' => $pago,
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Pago no encontrado',
            ], 400);
        }
    }
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880

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
<<<<<<< HEAD
        }
=======
         }
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
    }
};
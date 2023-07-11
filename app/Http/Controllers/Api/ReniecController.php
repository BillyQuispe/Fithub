<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReniecController extends Controller
{
    public function consultar(Request $request)
    {
        $dni = $request->input('dni');
        $token = 'apis-token-4918.3QGYUECRqrUotmEQjenpgww0NyYDclSn';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.apis.net.pe/v2/reniec/dni', [
            'numero' => $dni,
        ]);

        if ($response->successful() && $response['success']) {
            $resultado = [
                'apellidoPaterno' => $response['apellido_paterno'],
                'apellidoMaterno' => $response['apellido_materno'],
                'nombres' => $response['nombres'],
            ];

            return response()->json($resultado);
        }

        return response()->json(['error' => 'No se pudo obtener la información del DNI'], 400);
    }
}


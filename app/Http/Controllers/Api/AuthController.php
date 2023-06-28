<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Importamos Auth para atenticar y hash para encriptar la contraseña
use App\Models\User; //importamos el modelo usuarios
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(Request $request){
        $rules = [
            'name' => 'required|string|max:150',
            'dni' => 'required|string|max:8',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request -> input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $user = User::create([
            'name' => $request ->name,
            'dni' => $request ->dni,
            'email' => $request ->email,
            'password' => Hash::make($request ->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Usuario Creado Exitosamente!',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }
    public function login(Request $request){
        $rules = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request -> input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status' => false,
                'errors' => ['Unauthorized']
            ],401);
        }
        $user = User::where('email',$request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'Usuario logeado Exitosamente!',
            'data' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }
    public function logout(){
        auth()-> user()->token_get_all-> delete();
        return response()->json([
            'status' => true,
            'message' => 'Sesion Cerrada!',
        ],200);
    }
}

<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/
Route::post('auth/register',[AuthController::class,'create']);
Route::post('auth/login',[AuthController::class,'login']);
Route::post('/plan', [PlanController::class, 'store']);
Route::get('/plan', [PlanController::class, 'index']);
Route::get('/plan/{id}', [PlanController::class, 'show']);
Route::put('/plan/{id}', [PlanController::class, 'update']);
Route::delete('/plan/{id}', [PlanController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    //Metodos para Gimnasios

    
    //Metodos para planes
    



    Route::get('auth/logout', [PlanController::class, 'logout']);
});


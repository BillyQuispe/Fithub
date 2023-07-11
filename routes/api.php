<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ****** LOGIN ********
Route::post('login',[App\Http\Controllers\Api\LoginController::class, 'login']);
Route::apiResource('register',\App\Http\Controllers\Api\RegisterController::class)->only('store','update','destroy');
//

Route::apiResource('v1/gimnasios',\App\Http\Controllers\Api\V1\GimnasiosController::class)->only('show','store','update','destroy');
Route::apiResource('v1/planes', \App\Http\Controllers\Api\V1\PlanesController::class)->except(['update']);
Route::put('v1/planes/{plan}', [\App\Http\Controllers\Api\V1\PlanesController::class, 'update'])->name('planes.update');
Route::delete('v1/planes/{plan}', [\App\Http\Controllers\Api\V1\PlanesController::class, 'destroy'])->name('planes.destroy');
Route::apiResource('v1/pagos', \App\Http\Controllers\Api\V1\PagosController::class);
Route::apiResource('v1/gimnasios', \App\Http\Controllers\Api\V1\GimnasiosController::class);
Route::apiResource('v1/reseñas', \App\Http\Controllers\Api\V1\GimnasiosController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

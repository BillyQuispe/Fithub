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


Route::apiResource('v1/gimnasios',\App\Http\Controllers\Api\V1\GimnasiosController::class)->only('show','store','update','destroy');
<<<<<<< HEAD
Route::apiResource('v1/planes',\App\Http\Controllers\Api\V1\PlanesController::class);
Route::apiResource('v1/pagos', \App\Http\Controllers\Api\V1\PagosController::class);
Route::apiResource('v1/gimnasios', \App\Http\Controllers\Api\V1\GimnasiosController::class);
Route::apiResource('v1/usuarios', \App\Http\Controllers\Api\V1\UsuariosController::class);
=======
Route::apiResource('v1/planes', \App\Http\Controllers\Api\V1\PlanesController::class)->except(['update']);
Route::put('v1/planes/{plan}', [\App\Http\Controllers\Api\V1\PlanesController::class, 'update'])->name('planes.update');
Route::delete('v1/planes/{plan}', [\App\Http\Controllers\Api\V1\PlanesController::class, 'destroy'])->name('planes.destroy');
Route::apiResource('v1/pagos', \App\Http\Controllers\Api\V1\PagosController::class);
Route::apiResource('v1/gimnasios', \App\Http\Controllers\Api\V1\GimnasiosController::class);
Route::apiResource('v1/reseñas', \App\Http\Controllers\Api\V1\GimnasiosController::class);
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880



Route::apiResource('v1/planes', \App\Http\Controllers\Api\V1\PlanesController::class)->except(['update']);
Route::put('v1/planes/{plan}', [\App\Http\Controllers\Api\V1\PlanesController::class, 'update'])->name('planes.update');
Route::delete('v1/planes/{plan}', [\App\Http\Controllers\Api\V1\PlanesController::class, 'destroy'])->name('planes.destroy');


Route::apiResource('v1/pagos', \App\Http\Controllers\Api\V1\PagosController::class)->except(['update']);
Route::put('v1/pagos/{pago}', [\App\Http\Controllers\Api\V1\PagosController::class, 'update'])->name('pagos.update');
Route::delete('v1/pagos/{pago}', [\App\Http\Controllers\Api\V1\PagosController::class, 'destroy'])->name('pagos.destroy');


Route::apiResource('v1/usuarios', \App\Http\Controllers\Api\V1\UsuariosController::class)->except(['update']);
Route::put('v1/usuarios/{usuario}', [\App\Http\Controllers\Api\V1\UsuariosController::class, 'update'])->name('usuarios.update');
Route::delete('v1/usuarios/{usuario}', [\App\Http\Controllers\Api\V1\UsuariosController::class, 'destroy'])->name('usuarios.destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

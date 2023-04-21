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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::apiResource('eval/v1/clientes', App\Http\Controllers\Eval_\Api\V1\ClienteEvalController::class);
Route::apiResource('fidepuntos/v1/clientes', App\Http\Controllers\Fidepuntos\Api\V1\ClienteFidepuntosController::class)->middleware('auth:sanctum');
Route::apiResource('fidepuntos/v1/pedidos', App\Http\Controllers\Fidepuntos\Api\V1\PedidosFidepuntosController::class)->middleware('auth:sanctum');
Route::apiResource('fidepuntos/v1/productos', App\Http\Controllers\Fidepuntos\Api\V1\ProductosFidepuntosController::class);
Route::apiResource('fidepuntos/v1/infocompanias', App\Http\Controllers\Fidepuntos\Api\V1\InfocompaniasFidepuntosController::class);
Route::apiResource('fidepuntos/v1/mensajes', App\Http\Controllers\Fidepuntos\Api\V1\MensajesFidepuntosController::class);
Route::apiResource('grupogzr/v1/login', App\Http\Controllers\Grupogzr\Api\V1\LoginController::class);
/* ->middleware('auth:sanctum'); */
/* //Rutas Crud Clientas Eval
Route::get('eval/v1/clientes', [ClienteEvalController::class, 'index']);
Route::get('eval/v1/clientes/{id}', [ClienteEvalController::class, 'show']); */

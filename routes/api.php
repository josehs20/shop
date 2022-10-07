<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/calcula-frete', [\App\Http\Controllers\ServicosController::class, 'calculo_frete']);
Route::post('/rastreio-pedido', [\App\Http\Controllers\ServicosController::class, 'rastreio_pedido']);


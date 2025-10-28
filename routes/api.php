<?php

use App\Http\Controllers\OrderController;
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
Route::post('/orders/{orderId}/accept', [OrderController::class, 'acceptOrder']);
Route::get('/orders/{orderId}/track', [OrderController::class, 'trackOrder']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

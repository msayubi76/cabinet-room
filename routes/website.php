<?php


// });

use App\Http\Controllers\website\FrontendController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);
Route::get('/products', [FrontendController::class, 'products']);
Route::get('/singleproduct/{id}', [FrontendController::class, 'singleproduct']);



Route::middleware(['auth'])->group(function () {
    Route::post('add-to-cart', [CartController::class, 'addproduct']);
    Route::get('cart', [CartController::class, 'viewcart']);
    Route::post('update', [CartController::class, 'update']);
    Route::get('delete', [CartController::class, 'delete']);
});

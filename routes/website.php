<?php


// });

use App\Http\Controllers\website\FrontendController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckOutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);
Route::get('/products', [FrontendController::class, 'products']);
Route::get('/products/{id}', [FrontendController::class, 'singleproduct'])->name('website.single-product');

Route::get('check-out', [CheckOutController::class, 'index']);
Route::post('check-out', [CheckOutController::class, 'placeOrder']);

Route::middleware(['auth'])->group(function () {
    Route::post('add-to-cart', [CartController::class, 'addProduct']);
    Route::get('cart', [CartController::class, 'viewCart']);
    Route::post('update', [CartController::class, 'update']);
    Route::get('delete', [CartController::class, 'delete']);

});

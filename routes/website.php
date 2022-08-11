<?php


// });

use App\Http\Controllers\website\FrontendController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);
Route::get('/products', [FrontendController::class, 'products']);
Route::get('/products/{id}', [FrontendController::class, 'singleproduct'])->name('website.single-product');



Route::middleware(['auth'])->group(function () {
    Route::post('add-to-cart', [CartController::class, 'addProduct']);
    Route::get('cart', [CartController::class, 'viewCart']);
    Route::post('update', [CartController::class, 'update']);
    Route::get('delete', [CartController::class, 'delete']);
    Route::get('check-out', [CartController::class, 'index']);
});

<?php


// });

use App\Http\Controllers\websit\FrontendController;
use App\Http\Controllers\website\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);
Route::get('/product', [FrontendController::class, 'product']);
Route::get('/single_Product/{id}', [FrontendController::class, 'single_product']);

Route::middleware(['auth'])->group(function () {
    Route::post('add-to-cart', [CartController::class, 'add_product']);
});
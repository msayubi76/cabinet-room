<?php


// });

use App\Http\Controllers\website\FrontendController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckOutController;
use Illuminate\Support\Facades\Route;

// ----------> Webste layout <------------- //
Route::get('/', [FrontendController::class, 'index']);
Route::get('/products', [FrontendController::class, 'products']);
Route::get('/products/{id}', [FrontendController::class, 'singleproduct'])->name('website.single-product');
Route::get('/about-us', [FrontendController::class, 'about']);
Route::get('/contact-us', [FrontendController::class, 'contact']);
Route::get('/privacy-and-policy', [FrontendController::class, 'policy']);
Route::get('/category={name}', [FrontendController::class, 'category']);
Route::get('/product-list', [FrontendController::class, 'productList']);
Route::post('/search-product', [FrontendController::class, 'searchProduct']);

// ----------> Webste Checout <------------- //
Route::get('check-out', [CheckOutController::class, 'index']);
Route::post('check-out', [CheckOutController::class, 'store'])->name('website.checkout');

// ----------> Webste Cart <------------- //
Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::middleware(['auth'])->group(function () {

    Route::get('cart', [CartController::class, 'viewCart']);
    Route::post('update', [CartController::class, 'update']);
    Route::get('delete', [CartController::class, 'delete']);

});

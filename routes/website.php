<?php


// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckOutController;
use App\Http\Controllers\RequestQuoteController;
use App\Http\Controllers\website\FrontendController;
use App\Http\Controllers\website\UserDashboardController;
use App\Http\Controllers\website\GoogleAuthController;
use App\Http\Controllers\website\FacebookAuthController;

// ----------> Webste layout <------------- //
Route::get('/', [FrontendController::class, 'index']);

Route::get('products/{category?}/{sub_category?}', [FrontendController::class, 'products'])->name('products');
// Route::get('products-filter/{category?}/{sub_category?}', [FrontendController::class, 'productsFilter'])->name('productsFilter');

Route::get('product/{product}', [FrontendController::class, 'singleProduct'])->name('website.single-product');
Route::get('about-us', [FrontendController::class, 'about']);
Route::get('contact-us', [FrontendController::class, 'contact']);
Route::get('privacy-and-policy', [FrontendController::class, 'policy']);
Route::get('categories', [FrontendController::class, 'categories']);
Route::get('gallary', [FrontendController::class, 'gallary']);


// -------> Webste search filter <------ //
Route::get('product-list', [FrontendController::class, 'productList']);
Route::get('search', [FrontendController::class, 'searchProduct'])->name('searchProduct');
Route::post('search-filter', [FrontendController::class, 'searchProductFilter'])->name('searchProductFilter');




// ----------> Webste Cart <------------- //
Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('add-quote', [RequestQuoteController::class, 'store'])->name('requestQuote');
Route::get('update-quote-status/{id}/{status}', [RequestQuoteController::class, 'updateStatus'])->name('updateQuoteStatus');
Route::post('add-quote', [RequestQuoteController::class, 'store'])->name('requestQuote');

Route::get('cart', [CartController::class, 'viewCart']);
Route::get('delete', [CartController::class, 'delete']);
Route::post('update', [CartController::class, 'update']);
Route::get('check-out', [CheckOutController::class, 'index'])->name('check-out.index');

Route::middleware(['auth'])->group(function () {
    // ----------> Webste Checout <----------- //
    Route::post('check-out', [CheckOutController::class, 'store'])->name('check-out');



    Route::get('user-dashboard', [UserDashboardController::class, 'index'])->name('user-dashboard');
    Route::get('user-dashboard/order-detail/{order}', [UserDashboardController::class, 'orderDetail'])->name('order-detail');
    Route::put('update-profile', [UserDashboardController::class, 'updateinfo'])->name('updateinfo');
    Route::post('change-password', [UserDashboardController::class, 'changePassword'])->name('changePassword');
});
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callBackGoogle']);

Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook-auth');
Route::get('auth/facebook/call-back', [FacebookAuthController::class, 'callBackFacebook']);

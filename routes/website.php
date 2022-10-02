<?php


// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckOutController;
use App\Http\Controllers\website\FrontendController;
use App\Http\Controllers\website\UserDashboardController;

// ----------> Webste layout <------------- //
Route::get('/', [FrontendController::class, 'index']);
Route::get('products/{category?}/{sub_category?}', [FrontendController::class, 'products'])->name('products');
Route::get('product/{id}', [FrontendController::class, 'singleProduct'])->name('website.single-product');
Route::get('about-us', [FrontendController::class, 'about']);
Route::get('contact-us', [FrontendController::class, 'contact']);
Route::get('privacy-and-policy', [FrontendController::class, 'policy']);
Route::get('categories', [FrontendController::class, 'categories']);
Route::get('gallary', [FrontendController::class, 'gallary']);


// -------> Webste search filter <------ //
Route::get('product-list', [FrontendController::class, 'productList']);
Route::post('search-product', [FrontendController::class, 'searchProduct']);

// ----------> Webste Checout <----------- //
Route::get('check-out', [CheckOutController::class, 'index'])->name('check-out.index');
Route::post('check-out', [CheckOutController::class, 'store'])->name('check-out');

// ----------> Webste Cart <------------- //
Route::post('add-to-cart', [CartController::class, 'addProduct']);


Route::middleware(['auth'])->group(function () {

    Route::get('cart', [CartController::class, 'viewCart']);
    Route::post('update', [CartController::class, 'update']);
    Route::get('delete', [CartController::class, 'delete']);

    Route::get('user-dashboard', [UserDashboardController::class, 'index'])->name('user-dashboard');
    Route::get('user-dashboard/order-detail/{order}', [UserDashboardController::class, 'orderDetail'])->name('order-detail');
    Route::put('update-profile', [UserDashboardController::class, 'updateinfo'])->name('updateinfo');
Route::post('change-password', [UserDashboardController::class, 'changePassword'])->name('changePassword');
});

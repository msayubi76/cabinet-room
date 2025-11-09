<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use PHPUnit\TextUI\XmlConfiguration\Groups;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\RequestQuoteController;
use App\Http\Controllers\PaymentHistoryController;


Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth'])->name('dashboard');
// Route::group(['middleware' => ['auth']], function() {




Route::prefix('admin')->middleware(['isAdmin', 'auth'])->group(function () {
    Route::get('dashboard', function () {


        return view('home');
    })->name('dashboard');
    Route::get('/', function () {

        return view('home');
    })->name('home');

    Route::resource('users', UserController::class);
    Route::post('users/{user}', [UserController::class, 'update']);
    Route::get('userprofile', [UserController::class, 'profile']);
    Route::put('update-profile', [UserController::class, 'updateinfo'])->name('updateinfo');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('changePassword');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('attach-permission/{role}', [RoleController::class, 'attachPermission']);
    Route::post('attach-permissions', [RoleController::class, 'storeAttachPermissions'])->name('attach-permissions');

    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::put('product/variation/{variation?}', [ProductController::class, 'updateVariation'])->name('products.updateVariation');
    Route::delete('product/variation/{variation}', [ProductController::class, 'destroyVariation'])->name('products.destroyVariation');

    Route::get('settings', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('setting.update');
    Route::resource('banners', BannerController::class);


    Route::get('orders', [OrderController::class, 'index']);
    Route::get('{order_type}/orders', [OrderController::class, 'orderType'])->name('orders');
    Route::post('update', [OrderController::class, 'updateStatus'])->name('orders');

    Route::get('view-order/{order}', [OrderController::class, 'viewOrder']);
    Route::post('orders/{order}', [PaymentHistoryController::class, 'store']);
    Route::get('order/{order}', [PaymentHistoryController::class, 'paymentHistory']);
    Route::post('/orders/tcs-track', [OrderController::class, 'trackTcs']);
    Route::get('/orders/tcs-label', [OrderController::class, 'downloadTcsLabel']);
    //   Route::get('orders/payment/{id}',[PaymentHistoryController::class,'payment'])->name('order.payment');
    //   Route::post('orders/payment',[PaymentHistoryController::class,'store'])->name('order.payment');

    Route::get('delete/{id}', [MediaController::class, 'destroy']);
    Route::get('quote', [RequestQuoteController::class, 'index']);
    Route::post('quote', [RequestQuoteController::class, 'update'])->name('updateQuote');

    Route::any('getSubCategory', [ProductController::class, 'getSubCategory'])->name('getSubCategory');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/website.php';

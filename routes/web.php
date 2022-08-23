<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use PHPUnit\TextUI\XmlConfiguration\Groups;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubCategoryController;


Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth'])->name('dashboard');
// Route::group(['middleware' => ['auth']], function() {




Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('home');
    })->name('dashboard');
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::resource('users', UserController::class); //->except('update');
    Route::post('users/{user}', [UserController::class, 'update']);
    Route::get('userprofile', [UserController::class, 'profile']);
    Route::put('update-profile', [UserController::class, 'updateinfo'])->name('updateinfo');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('changePassword');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class); //->except('update');  salahuddin changed
    Route::get('attach-permission/{role}', [RoleController::class, 'attachPermission']);
    Route::post('attach-permissions', [RoleController::class, 'storeAttachPermissions'])->name('attach-permissions');

    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('settings', SettingController::class);


    Route::get('orders',[OrderController::class,'index']);

    Route::any('getSubCategory', [ProductController::class, 'getSubCategory'])->name('getSubCategory');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/website.php';

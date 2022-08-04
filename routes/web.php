<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\ProductController;
use PHPUnit\TextUI\XmlConfiguration\Groups;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\websit\FrontendController;
use App\Http\Controllers\website\CartController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth'])->name('dashboard');
// Route::group(['middleware' => ['auth']], function() {


// });
Route::get('/',[FrontendController::class,'index']);
Route::get('/product',[FrontendController::class,'product']);
Route::get('/single_Product/{id}',[FrontendController::class,'single_product']);
Route::middleware(['auth'])->group(function () {
Route::post('add-to-cart',[CartController::class,'add_product']);
});

Route::prefix('admin')->middleware(['auth'])->group(function ()
{
    Route::get('dashboard', function () {
        return view('home');
    })->name('dashboard');
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::resource('users',UserController::class); //->except('update');
    Route::post('users/{user}',[UserController::class,'update']);
    Route::get('userprofile',[UserController::class,'profile']);
    Route::put('update-profile',[UserController::class,'updateinfo'])->name('updateinfo');
    Route::post('change-password',[UserController::class,'changePassword'])->name('changePassword');

    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);//->except('update');  salahuddin changed
    Route::get('attach-Role/{role}',[RoleController::class,'attachRole']);
    Route::post('attach-permissions',[RoleController::class,'attachPermissions'])->name('attach-permissions');
    Route::get('updatAttachRole/{role}',[RoleController::class,'updateAttachRole']);
    Route::post('update-attach-permissions',[RoleController::class,'updateAttachPermissions'])->name('update-attach-permissions');

    Route::resource('category',CategoryController::class);
    Route::resource('subcategory',SubCategoryController::class);
    Route::resource('products',ProductController::class);
    // Route::get('products',[ProductController::class,'index'])->name('product.index');
    // Route::get('products/create',[ProductController::class,'create']);
    // Route::post('products/store',[ProductController::class,'store'])->name('products.store');
    // Route::get('products/update/{product_id}',[ProductController::class,'edit']);
    // Route::post('products/update/{product_id}',[ProductController::class,'update'])->name('products.update');
    // Route::Delete('/products/{id}',[ProductController::class,'destroy']);
    Route::any('getSubCategory',[ProductController::class,'getSubCategory'])->name('getSubCategory');



});

require __DIR__.'/auth.php';

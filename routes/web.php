<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use PHPUnit\TextUI\XmlConfiguration\Groups;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth'])->name('dashboard');
// Route::group(['middleware' => ['auth']], function() {


// });


Route::prefix('admin')->middleware(['auth'])->group(function ()
{
    Route::get('dashboard', function () {
        return view('home');
    })->name('dashboard');

    Route::resource('users',UserController::class); //->except('update');
    Route::post('users/{user}',[UserController::class,'update']);
    Route::get('userprofile',[UserController::class,'profile']);
    Route::put('update-profile',[UserController::class,'updateinfo'])->name('updateinfo');
    Route::post('change-password',[UserController::class,'changePassword'])->name('changePassword');

    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);//->except('update');  salahuddin changed
    Route::get('attach-permission/{role}',[RoleController::class,'attach']);
    Route::post('attach-permission',[RoleController::class,'permissionassign']);

    Route::resource('category',CategoryController::class);
    Route::resource('subcategory',SubCategoryController::class);
    Route::get('products',[ProductController::class,'index']);
    Route::get('products/create',[ProductController::class,'create']);
    Route::post('products/store',[ProductController::class,'store'])->name('products/store');
    Route::get('products/update/{product_id}',[ProductController::class,'edit']);
    Route::any('getSubCategory',[ProductController::class,'getSubCategory'])->name('getSubCategory');



});

require __DIR__.'/auth.php';

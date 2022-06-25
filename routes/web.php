<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => ['auth']], function() {
Route::resource('users',UserController::class)->except('update');
Route::post('users/{user}',[UserController::class,'update']);
Route::get('userprofile',[UserController::class,'profile']);
Route::post('update-profile',[UserController::class,'updateinfo'])->name('updateinfo');
Route::post('change-password',[UserController::class,'changePassword'])->name('changePassword');

Route::resource('roles',RoleController::class)->except('update');
});

require __DIR__.'/auth.php';

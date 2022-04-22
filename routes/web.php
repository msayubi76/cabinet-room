<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\QuoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BalanceSheetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\JdmPartsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CommController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [HomeController::class, 'index']); 
Route::get('products', [HomeController::class, 'getAllProducts']); 
Route::get('parts', [HomeController::class, 'parts']);
Route::get('part-detail/{part_id}', [HomeController::class, 'partDetail']);
Route::get('/parts-top', [HomeController::class, 'partstop']);
Route::get('productparts', [HomeController::class, 'productparts']);

Route::resource('quote',QuoteController::class); 
Route::get('quote/create/{id}', [QuoteController::class, 'create']);
Route::get('produc/{id}', [HomeController::class,'show'])->name('product');
Route::get('produc/{id}', [HomeController::class,'show'])->name('product');
Route::post('search_products', [HomeController::class,'searchProducts']);
Route::post('register/customer', [UserController::class, 'registerCustomer'] );
Route::get('damage/products', [HomeController::class,'getDamageProducts'])->name('damage/products');

Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('bank-detail', [HomeController::class,'bankDetail']);
Route::get('about', [HomeController::class,'about']);
Route::get('contact-us', [HomeController::class,'contact']); 
Route::get('country/{country}', [HomeController::class,'searchByCountry']);

Route::resource('user',UserController::class);
Route::post('user/updatePssword',[UserController::class,'updatePssword']);
Route::get('change/password',[UserController::class,'changePassword']);
Route::post('save-change-password',[UserController::class,'saveChangePassword']);
Route::get('edit/profile/{id}',[UserController::class,'editProfile']);
Route::put('user/update-profile/{user}',[UserController::class,'updateProfile']);
Route::post('user/updateStatus/{id}',[UserController::class,'updateStatus']);

Route::resource('role',RoleController::class);


Route::resource('category',CategoryController::class);
Route::post('updateCategory',[CategoryController::class,'updateCategory']);
Route::post('editCategory/{id}', [CategoryController::class,'editCategory']);

Route::resource('sub_category',SubCategoryController::class);
Route::post('editSubCategory/{id}',[SubCategoryController::class,'editSubCategory']);
Route::post('updateSubCategory', [SubCategoryController::class,'updateSubCategory']);
Route::post('sub_category/getSubCategories/{id}',[SubCategoryController::class,'getSubCategories']);

Route::post('savePayment',[BalanceSheetController::class,'savePayment']);
Route::resource('product', ProductController::class);


Route::get('quotation',[OrderController::class,'getQuotationOrderForAdmin']);
Route::get('order/in_process',[OrderController::class,'getInProcessOrderForAdmin']);
Route::get('order/completed',[OrderController::class,'getCompletedOrderForAdmin']);
Route::get('order/rejected',[OrderController::class,'getRejectedForAdmin']);
Route::get('order/detail/{id}',[OrderController::class,'getOrderDetail']);
Route::post('order/reject/{id}',[OrderController::class,'rejectOrder']);
Route::post('order/complete/{id}',[OrderController::class,'completetOrder']);
Route::post('order/shipping_detail',[OrderController::class,'addShippingDetail']);
Route::get('updatePrice',[OrderController::class,'updatePrice']);

Route::post('upload_product_documents',[MediaController::class,'uploadProductDocuments']);
Route::get('documents/{id}',[MediaController::class,'getDocuments']);
Route::delete('remove_file/{id}',[MediaController::class,'deleteFile']);


Route::resource('general/setting', GeneralSettingController::class);

Route::resource('jdm_part', JdmPartsController::class); 

Route::group(['middleware' => ['role:Customer']], function () {
    Route::get('customer/draft',[TransactionController::class,'getReservedCars']);
    Route::get('customer/orders',[TransactionController::class,'getShippedCars']);
    Route::get('customer/shipped',[ProductController::class,'getShippedCars']);
    Route::get('customer/payments',[BalanceSheetController::class,'getCustomerPayments']);
    Route::get('customer/payment/detail/{id}',[BalanceSheetController::class,'getCustomerPaymentDetail']);

    Route::get('customer/quotation',[OrderController::class,'getQuotationOrderForCustomer']);
    Route::get('customer/accepted',[OrderController::class,'getInProcessOrderForCustomer']);
    Route::get('customer/completed',[OrderController::class,'getCompletedOrderForCustomer']);
});

Route::post('customer/save',[UserController::class,'storeCustomer']);
Route::get('customer/create',[UserController::class,'createCustomer']);
Route::post('find_customer',[UserController::class,'findCustomer']);


// only user for developer
Route::resource('permission',PermissionController::class);
Route::get('php_artisan_migrate',[CommController::class,'index']);


require __DIR__.'/auth.php';

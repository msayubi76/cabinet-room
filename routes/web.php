<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
 

 
Route::get('/', 'Website\HomeController@index');
Route::get('products', 'Website\HomeController@getAllProducts');
Route::get('parts', 'Website\HomeController@parts');
Route::get('part-detail/{part_id}', 'Website\HomeController@partDetail');
Route::get('/parts-top', 'Website\HomeController@partstop');
Route::get('productparts', 'Website\HomeController@productparts');

Route::resource('quote','Website\QuoteController');
Route::get('quote/create/{id}', 'Website\QuoteController@create');
Route::get('produc/{id}', 'Website\HomeController@show')->name('product');
Route::get('produc/{id}', 'Website\HomeController@show')->name('product');
Route::post('search_products', 'Website\HomeController@searchProducts');
Route::post('register/customer', 'UserController@registerCustomer');
Route::get('damage/products', 'Website\HomeController@getDamageProducts')->name('damage/products');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('bank-detail', 'Website\HomeController@bankDetail');
Route::get('about', 'Website\HomeController@about');
Route::get('contact-us', 'Website\HomeController@contact'); 
Route::get('country/{country}', 'Website\HomeController@searchByCountry');

Route::get('/dashboard', 'HomeController@index');

Route::resource('user','UserController');
Route::post('user/updatePssword','UserController@updatePssword');
Route::get('change/password','UserController@changePassword');
Route::post('save-change-password','UserController@saveChangePassword');
Route::get('edit/profile/{id}','UserController@editProfile');
Route::put('user/update-profile/{user}','UserController@updateProfile');
Route::post('user/updateStatus/{id}','UserController@updateStatus');
Route::resource('role','RoleController');


Route::resource('category','CategoryController');
Route::post('updateCategory','CategoryController@updateCategory');

Route::post('editCategory/{id}', 'CategoryController@editCategory');

Route::resource('sub_category','SubCategoryController');
Route::post('editSubCategory/{id}','SubCategoryController@editSubCategory');
Route::post('updateSubCategory', 'SubCategoryController@updateSubCategory');
Route::post('sub_category/getSubCategories/{id}','SubCategoryController@getSubCategories');


Route::post('savePayment','BalanceSheetController@savePayment');
Route::resource('product', 'ProductController');




Route::get('quotation','OrderController@getQuotationOrderForAdmin');
Route::get('order/in_process','OrderController@getInProcessOrderForAdmin');
Route::get('order/completed','OrderController@getCompletedOrderForAdmin');
Route::get('order/rejected','OrderController@getRejectedForAdmin');

 
Route::get('order/detail/{id}','OrderController@getOrderDetail');
Route::post('order/reject/{id}','OrderController@rejectOrder');
Route::post('order/complete/{id}','OrderController@completetOrder');

Route::post('order/shipping_detail','OrderController@addShippingDetail');

Route::get('updatePrice','OrderController@updatePrice');

Route::post('upload_product_documents','MediaController@uploadProductDocuments');

Route::get('documents/{id}','MediaController@getDocuments');
Route::delete('remove_file/{id}','MediaController@deleteFile');


Route::resource('general/setting', 'GeneralSettingController');
Route::resource('jdm_part', 'JdmPartsController'); 

Route::group(['middleware' => ['role:Customer']], function () {
    Route::get('customer/draft','TransactionController@getReservedCars');
    Route::get('customer/orders','TransactionController@getShippedCars');
    Route::get('customer/shipped','ProductController@getShippedCars');
    Route::get('customer/payments','BalanceSheetController@getCustomerPayments');
    Route::get('customer/payment/detail/{id}','BalanceSheetController@getCustomerPaymentDetail');

    Route::get('customer/quotation','OrderController@getQuotationOrderForCustomer');
    Route::get('customer/accepted','OrderController@getInProcessOrderForCustomer');
    Route::get('customer/completed','OrderController@getCompletedOrderForCustomer');
});

Route::post('customer/save','UserController@storeCustomer');
Route::get('customer/create','UserController@createCustomer');
Route::post('find_customer','UserController@findCustomer');


// only user for developer
Route::resource('permission','PermissionController');
Route::get('php_artisan_migrate','CommController@index');
      


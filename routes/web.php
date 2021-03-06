<?php
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
Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('/home', 'HomeController@index')->name('index');
Route::get('/logout','HomeController@logOut');
Auth::routes();

Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');


// Admin Route Start
Route::prefix('admin')->name('admin.')->middleware(['isAdmin'])->group(function(){
	Route::get('dashboard','AdminController@index')->name('dashboard');
	Route::get('user-control','Admin\UserController@index')->name('user');
	Route::resource('users','Admin\UserController');
	Route::get('product-control','Admin\ProductController@index')->name('product');
	Route::resource('products','Admin\ProductController');
	Route::get('category-control','Admin\CategoryController@index')->name('category');
	Route::resource('categories','Admin\CategoryController');
	Route::get('order-control','Admin\OrderController@index')->name('order');
	Route::resource('orders','Admin\OrderController');
	

});


// User Route Start
Route::get('users/homepage','User\ProductController@homepage')->name('homepage');
Route::get('users/my-products','User\ProductController@myproducts')->name('products.myproducts');
Route::get('users/my-products-api','User\ProductController@myproductsApi')->name('products.myproductsApi');
Route::resource('products','User\ProductController');
Route::get('users/order/checkout_register','User\OrderController@checkout_register')->name('checkout_register');
Route::post('users/order/bill_details','User\OrderController@bill_details')->name('bill_details');
Route::get('users/order/bill_details','User\OrderController@bill_details_show')->name('bill_details_show');
Route::resource('orders','User\OrderController');



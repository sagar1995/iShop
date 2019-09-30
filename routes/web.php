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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/home', 'HomeController@index')->name('index');
Auth::routes();
Route::get('/logout','HomeController@logOut');

Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

// Admin Route Start
Route::get('admin/dashboard', 'AdminController@index')->name('dashboard');


// Product Route Start
Route::get('users/homepage', 'ProductController@homepage')->name('homepage');
Route::get('users/my-products','ProductController@myproducts')->name('products.myproducts');
Route::resource('products','ProductController');



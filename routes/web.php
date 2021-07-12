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
// Home
Route::get('/', 'HomeController@index')->name('home');
Route::post('/tim-kiem', 'HomeController@search');

Route::get('/category/{slug}/{id}',[
    'as' => 'category.product',
    'uses' => 'CategoryController@index'
]);
// Product
Route::get('/product/{id}',[
    'as' => 'product.detail',
    'uses' => 'ProductController@index'
]);
Route::get('/thuc-don','ProductController@list_menu');
// Cart
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/gio-hang','CartController@gio_hang'); 

Route::post('/update-cart','CartController@update_cart');
Route::get('/delete-product/{session_id}','CartController@delete_product');
Route::get('/delete-all','CartController@delete_all_product');

// Coupon
Route::post('/check-coupon','CartController@check_coupon');


//Checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login','CheckoutController@login');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/show-checkout','CheckoutController@show_checkout');
Route::post('/save-checkout','CheckoutController@save_checkout');
//Payment
Route::get('/payment','CheckoutController@payment');
Route::post('/save-bill','CheckoutController@save_bill');
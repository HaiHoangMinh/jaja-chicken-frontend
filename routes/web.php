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
// Liên hệ 
Route::get('/lien-he', 'ContactController@index');
//Promotion
Route::get('/khuyen-mai', 'PromotionController@index');
Route::get('/khuyen-mai/{id}/{slug}', 'PromotionController@detail');
// Product
Route::get('/product/{id}',[
    'as' => 'product.detail',
    'uses' => 'ProductController@index'
]);
Route::get('/thuc-don','ProductController@list_menu');
Route::post('/load-feedback','ProductController@load_feedback');
Route::post('/send-feedback','ProductController@send_feedback');
Route::post('/insert-rating','ProductController@insert_rating');

// Cart
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/gio-hang','CartController@gio_hang'); 
Route::post('/update-cart','CartController@update_cart');
Route::get('/delete-product/{session_id}','CartController@delete_product');
Route::get('/delete-all','CartController@delete_all_product');
Route::get('/show-cart','CartController@show_cart');

// Send mail
Route::get('/send-mail','MailController@send_mail'); 
Route::get('/quen-mat-khau','MailController@quen_mat_khau'); 
Route::post('/reset-pass','MailController@reset_pass'); 
Route::get('/update-new-pass','MailController@update_new_pass'); 
Route::post('/reset-new-pass','MailController@reset_new_pass'); 

//Login facebook
Route::get('/login-facebook','LoginController@login_facebook');
Route::get('/customer/facebook/callback','LoginController@callback_facebook');

//Login google
Route::get('/login-google','LoginController@login_google');
Route::get('/customer/google/callback','LoginController@callback_google');


// Coupon
Route::post('/check-coupon','CartController@check_coupon');
Route::get('/unset-coupon','CartController@unset_coupon');


//Checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/select-address','CheckoutController@select_address');
Route::post('/login','CheckoutController@login');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/show-checkout','CheckoutController@show_checkout');
Route::post('/save-checkout','CheckoutController@save_checkout');

// Account

Route::get('/khach-hang','AccountController@index');
Route::get('/lich-su-mua-hang','AccountController@history');
Route::get('/doi-mat-khau','AccountController@change_pass');
Route::get('/doi-dia-chi','AccountController@change_address');
Route::get('/vi-coupon','AccountController@show_coupoun');
Route::post('/update-address','AccountController@update_address');
Route::post('/update-pass','AccountController@update_password');
Route::post('/update-account','AccountController@update_account');
Route::get('/lich-su-chi-tiet/{id}','AccountController@history_detail');
Route::post('/huy-don','AccountController@cancel_bill');

//Payment
Route::get('/payment','CheckoutController@payment');
Route::post('/save-bill','CheckoutController@save_bill');
Route::get('/payment-atm','CheckoutController@create');
Route::get('/return-vnpay','CheckoutController@return');
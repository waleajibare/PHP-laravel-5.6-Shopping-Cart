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

Route::get('/', 'HomeController@index');


Route::get('/product_by_category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product_by_brand/{manufacture_id}', 'HomeController@show_product_by_brand');
Route::get('/view_product/{product_id}', 'HomeController@product_details');


Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');
Route::post('/update-cart', 'CartController@update_cart');



Route::get('/login-check', 'CheckoutController@login_check');
Route::post('/customer-registration', 'CheckoutController@customer_registration');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-shipping-details', 'CheckoutController@save_shipping_details');



Route::post('/customer-login', 'CheckoutController@customer_login');
Route::get('/customer-logout', 'CheckoutController@customer_logout');


Route::get('/payment', 'CheckoutController@payment');
Route::post('/place-order', 'CheckoutController@place_order');

Route::get('/manage-order', 'CheckoutController@manage_order');
Route::get('/view-order/{order_id}', 'CheckoutController@view_order');





// backend routes
Route::get('/logout', 'SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');
Route::post('/admin-dashboard', 'AdminController@dashboard');


Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/unactive_category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active_category/{category_id}', 'CategoryController@active_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');


Route::get('/add-brand', 'BrandController@index');
Route::post('/save-brand', 'BrandController@save_brand');
Route::get('/all-brand', 'BrandController@all_brand');
Route::get('/delete-brand/{manufacture_id}', 'BrandController@delete_brand');
Route::get('/unactive_brand/{manufacture_id}', 'BrandController@unactive_brand');
Route::get('/active_brand/{manufacture_id}', 'BrandController@active_brand');
Route::get('/edit-brand/{manufacture_id}', 'BrandController@edit_brand');
Route::post('/update-brand/{manufacture_id}', 'BrandController@update_brand');


Route::get('/add-product', 'ProductController@index');
Route::get('/all-product', 'ProductController@all_product');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/unactive_product/{product_id}', 'ProductController@unactive_product');
Route::get('/active_product/{product_id}', 'ProductController@active_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');


Route::get('/add-slider', 'SliderController@index');
Route::get('/all-slider', 'SliderController@all_slider');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/unactive_slider/{slider_id}', 'SliderController@unactive_slider');
Route::get('/active_slider/{slider_id}', 'SliderController@active_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');

















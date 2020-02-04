
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



Route::get('/', 'ProductsController@index');

Route::get('cart', 'ProductsController@cart');

Route::get('add-to-cart/{id}', 'ProductsController@addToCart');
Route::get('add-to-dbcart/{id}', 'CartsController@addToCart');

Route::post('add-to-cart-session-ajax', 'ProductsController@addToCartAjaxSession');
Route::post('add-to-cart-db-ajax', 'CartsController@addToCartAjaxDb');

Route::patch('update-cart', 'CommanController@update');

Route::delete('remove-from-cart', 'CommanController@remove');

Route::get('printtree', 'CommanController@printtree');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

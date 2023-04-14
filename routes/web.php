<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// Client
Route::namespace('Client')->prefix('/')->group(function () {
    Route::namespace('Auth')->prefix('auth')->group(function () {
        Route::get('/login', 'AuthController@showLogin')->name('auth.show.login');
        Route::post('/login', 'AuthController@login')->name('auth.post.login');
        Route::get('/register', 'AuthController@showRegister')->name('auth.show.register');
        Route::post('/register', 'AuthController@register')->name('auth.post.register');
        Route::get('/logout', 'AuthController@logout')->name('auth.logout');
        Route::get('/change-account', 'AuthController@changeAccount')->name('auth.change.account');
        Route::post('/change-account', 'AuthController@postChangeAccount')->name('auth.post.change.account');
    });

    Route::get('', 'HomeController@index')->name('client.home');
    Route::get('introduce', 'HomeController@introduce')->name('client.introduce');
    Route::get('product', 'ProductController@product')->name('client.product');
    Route::get('product-detail/{id}', 'ProductController@product_detail')->name('client.product.detail');
    Route::get('product-search','ProductController@search')->name('client.search.product');
    Route::get('product-brand/{brand}','ProductController@brand')->name('client.product.brand');
    Route::get('add-to-cart', 'ProductController@addToCart');
    Route::get('delete-item/{id}', 'ProductController@deleteItem')->name('delete.item');
    Route::get('shopping-cart', 'OrderController@shopping_cart')->name('client.shopping.cart');
    Route::get('checkout', 'OrderController@checkout')->name('client.checkout');
    Route::post('pay','OrderController@pay')->name('pay');
    Route::get('thank','OrderController@thank')->name('thank');
    Route::get('filter', 'ProductController@filter');
    Route::get('sort', 'ProductController@sort');
    Route::get('my-order','OrderController@myOrder')->name('my.order');
    Route::get('my-order/{id}','OrderController@showMyOrder')->name('my.order.show');
    Route::get('wishlist','ProductController@wishlist')->name('client.wishlist');
    Route::get('add-wishlist/{id}','ProductController@addWishlist')->name('client.add.wishlist');
    Route::get('delete-wishlist/{id}','ProductController@deleteWishlist')->name('client.delete.wishlist');
    Route::get('check-voucher', 'OrderController@checkVoucher');
});

// Admin
Route::namespace('Admin')->prefix('ad')->group(function () {
    Route::get('/', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('admin.form.login');
        }
        return redirect()->route('admin.form.login');
    });
    // Login, logout
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.form.login');
    Route::post('/login', 'LoginController@login')->name('admin.handle.login');
    Route::get('/logout', 'LoginController@logout')->name('admin.handle.logout');
    Route::group(['middleware' => 'check.admin.login'], function() {
        // Dashboard
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        // Brand
        Route::group(['prefix' => 'brand'],function(){
            Route::get('list','BrandController@index')->name('brand.list');

            Route::get('edit/{id}','BrandController@edit')->name('brand.edit.form');

            Route::post('edit/{id}','BrandController@update')->name('brand.edit');

            Route::get('add','BrandController@create')->name('brand.add.form');

            Route::post('add','BrandController@store')->name('brand.add');

            Route::get('delete/{id}','BrandController@destroy')->name('brand.delete');
        });
        // Color
        Route::group(['prefix' => 'color'],function(){
            Route::get('list','ColorController@index')->name('color.list');

            Route::get('edit/{id}','ColorController@edit')->name('color.edit.form');

            Route::post('edit/{id}','ColorController@update')->name('color.edit');

            Route::get('add','ColorController@create')->name('color.add.form');

            Route::post('add','ColorController@store')->name('color.add');

            Route::get('delete/{id}','ColorController@destroy')->name('color.delete');
        });
        // Product
        Route::group(['prefix' => 'product'],function(){
            Route::get('list','ProductController@index')->name('product.list');

            Route::get('edit/{id}','ProductController@edit')->name('product.edit.form');

            Route::post('edit/{id}','ProductController@update')->name('product.edit');

            Route::get('add','ProductController@create')->name('product.add.form');

            Route::post('add','ProductController@store')->name('product.add');

            Route::get('delete/{id}','ProductController@destroy')->name('product.delete');

            Route::get('update-status/{id}/{status}','ProductController@updateStatus')->name('product.update.status');

            Route::get('show/{id}','ProductController@show')->name('product.show');
        });
        // User
        Route::group(['prefix' => 'user'],function(){
            Route::get('list','UserController@index')->name('user.list');

            Route::get('delete/{id}','UserController@destroy')->name('user.delete');

            Route::get('disable/{id}','UserController@disable')->name('user.disable');

            Route::get('enable/{id}','UserController@enable')->name('user.enable');
        });
        // Order
        Route::group(['prefix' => 'order'],function(){
            Route::get('list','OrderController@index')->name('order.list');

            Route::get('show/{id}','OrderController@show')->name('order.show');

            Route::post('edit/{id}','OrderController@update')->name('order.edit');

            Route::get('print/{id}','OrderController@print')->name('order.print');
        });
    });
});


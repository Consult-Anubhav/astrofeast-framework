<?php

use Illuminate\Support\Facades\Route;

// Portal Page Routes
Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin'
], function () {
    // Guest User Routes
    Route::get('/signin', 'Controller@indexSignin')->name('login');
    // Google oauth
    Route::get('authorized/google', 'Controller@redirectToGoogle');
    Route::get('authorized/google/callback', 'Controller@handleGoogleCallback');
    // Auth User Routes
    Route::get('/', 'AuthController@indexDashboard')->name('home');
    Route::get('/dashboard', 'AuthController@indexDashboard')->name('dashboard');
    Route::get('/orders', 'AuthController@indexOrders');
    Route::get('/payments', 'AuthController@indexPayments');
    Route::get('/notifications', 'AuthController@indexNotifications');
    Route::get('/categories', 'AuthController@indexCategories');
    Route::get('/category', 'AuthController@indexCategory');
    Route::get('/products', 'AuthController@indexProducts');
    Route::get('/product', 'AuthController@indexProduct');
    Route::get('/product_variant', 'AuthController@indexProductVariant');
    Route::get('/pricings', 'AuthController@indexPricings');
    Route::get('/discounts', 'AuthController@indexDiscounts');
    Route::get('/customers', 'AuthController@indexCustomers');
});


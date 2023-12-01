<?php

use Illuminate\Support\Facades\Route;

// API Routes
Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/api'
], function () {
    // User APIs
    Route::get('/signout', 'Controller@signout')->name('logout');
    Route::post('/dark_mode_toggle', 'AuthController@getUser');
    // Common APIs
    Route::post('/common/upload', 'Controller@commonUpload');
    Route::post('/common/search_category', 'Controller@commonSearchCategory');
    Route::post('/common/search_metatag', 'Controller@commonSearchMetaTag');
    // Product Module
    Route::post('/products/get_list', 'AuthController@getListProducts');
    Route::post('/products/action', 'AuthController@actionListProducts');
    Route::post('/product/get_details', 'AuthController@getDetailsProduct');
    Route::post('/product/action', 'AuthController@actionDetailsProduct');
    Route::post('/product_variant/get_details', 'AuthController@getDetailsProductVariant');
    Route::post('/product_variant/action', 'AuthController@actionDetailsProductVariant');
    // Orders
    Route::post('/orders', 'AuthController@getListOrders');
    // Payments
    Route::post('/payments', 'AuthController@getListPayments');
    // Category Module
    Route::get('/categories/get_list', 'AuthController@getListCategories');
    Route::post('/categories/action', 'AuthController@actionCategories');
});
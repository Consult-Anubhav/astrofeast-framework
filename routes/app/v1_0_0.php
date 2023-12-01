<?php

use Illuminate\Support\Facades\Route;

$version = 'v1.0.0';
$version_dir = str_replace('.', '_', $version);
// Customer Guest API Routes
Route::group([
    'namespace' => 'App\Http\Controllers\\'.$version_dir,
    'prefix' => 'admin/guest/api/'.$version,
    'middleware' => ['auth:sanctum']
], function () {
    Route::post('/register', 'CustomerController@registerCustomer');
    Route::post('/login', 'CustomerController@loginCustomer');
});
// Customers API Routes
Route::group([
    'namespace' => 'App\Http\Controllers\\'.$version_dir,
    'prefix' => 'admin/customers/api/'.$version,
    'middleware' => ['auth:sanctum']
], function () {
    // Customer Auth
    Route::post('/logout', 'CustomerAuthController@logoutCustomer');
    // Manage Profile
    Route::post('/update_profile', 'CustomerAuthController@updateProfile');
    // Manage Cart
    Route::post('/cart', 'CustomerAuthController@getCart');
    Route::post('/add_to_cart', 'CustomerAuthController@addToCart');
});
// Customers Test API Routes
Route::group([
    'namespace' => 'App\Http\Controllers\\'.$version_dir,
    'prefix' => 'admin/test/customers/api/'.$version,
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/select_product', 'TestController@getProduct');
    Route::post('/cart', 'CustomerAuthController@getCart');
});
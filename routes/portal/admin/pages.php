<?php

use Illuminate\Support\Facades\Route;

// Portal Guest API Routes
Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/guest/api'
], function () {
    Route::post('/signin', 'Controller@signin');
    Route::post('/test_login', 'Controller@checkLogin');
});
// Portal Page Routes
Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/settings'
], function () {
    // Auth Admin User Routes
    Route::get('/dashboard', 'AdminController@indexSettings');
    Route::get('/store', 'AdminController@indexStore');
    Route::get('/addresses', 'AdminController@indexRegions');
    Route::get('/currencies', 'AdminController@indexCurrencies');
    Route::get('/roles', 'AdminController@indexRoles');
    Route::get('/staff', 'AdminController@indexStaff');
    Route::get('/taxes', 'AdminController@indexTaxes');
    Route::get('/integrations', 'AdminController@indexIntegrations');
    Route::get('/filemanager', 'AdminController@indexFileManager');
    Route::get('/permissions', 'AdminController@indexPermissions');
    Route::get('/shippings', 'AdminController@indexShippings');
    Route::get('/integrations', 'AdminController@indexIntegrations');
});
<?php

use Illuminate\Support\Facades\Route;

// API Routes
Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin/api'
], function () {
    // Admin User APIs
    // Role Module
    Route::get('/common/roles/get_list', 'AdminController@getListRoles');
    Route::post('/roles/action', 'AdminController@actionRoles');
    // Staff Module
    Route::get('/staff/get_list', 'AdminController@getListStaff');
    Route::post('/staff/action', 'AdminController@actionStaff');
    // Permission Module
    Route::get('/common/modules/get_list', 'AdminController@getListModules');
    Route::get('/permissions/get_list', 'AdminController@getListRolePermissions');
    Route::post('/permissions/action', 'AdminController@actionRolePermissions');
    // Integration Module
    Route::get('/integrations/get_list', 'AdminController@getAllIntegrations');
    Route::post('/integrations/generate_token', 'AdminController@actionGenerateToken');
    Route::post('/integrations/action', 'AdminController@actionIntegrations');
    // Addresses Module
    Route::post('/addresses/regions/get_list', 'AdminController@getAllRegions');
    Route::post('/addresses/regions/action', 'AdminController@actionRegions');
    Route::post('/addresses/provinces/get_list', 'AdminController@getAllProvinces');
    Route::post('/addresses/provinces/action', 'AdminController@actionProvinces');
    Route::post('/addresses/get_list', 'AdminController@getAllAddresses');
    Route::post('/addresses/action', 'AdminController@actionAddresses');
});
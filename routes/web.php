<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Route;
// Import Portal Routes
require __DIR__ . '/portal/pages.php';
require __DIR__ . '/portal/api.php';
require __DIR__ . '/portal/admin/pages.php';
require __DIR__ . '/portal/admin/api.php';
//// Import App Routes
require __DIR__ . '/app/v1_0_0.php';



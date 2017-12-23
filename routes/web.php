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

use igorgrabarski\LCBO;

Route::get('/', function () {
    $lcbo = new LCBO();

    $stores = $lcbo->getStores(1,50, null,null,null,null,null,null,null,'n6g5e4');

    return view('welcome', ['stores' => $stores]);
});

<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('productcateory')->group(function() {
    Route::get('/', 'ProductCateoryController@index');
    Route::post('/store', 'ProductCateoryController@categorystore');
    Route::get('/delete/{id:id}', 'ProductCateoryController@delete');
});

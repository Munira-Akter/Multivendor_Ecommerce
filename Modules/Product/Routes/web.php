<?php

use Illuminate\Support\Facades\Route;


Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::get('/add-product', 'ProductController@create')->name('product.add');
    Route::post('/add-product', 'ProductController@store')->name('product.store');
});

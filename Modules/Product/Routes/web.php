<?php

use Illuminate\Support\Facades\Route;


Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::get('/add-product', 'ProductController@create')->name('product.add');
    Route::post('/add-product', 'ProductController@productstore')->name('product.store');
    Route::get('/trash', 'ProductController@trashindex')->name('product.trash');
    Route::get('/trash/{id:id}', 'ProductController@trash');
    Route::get('/recovery/{id:id}', 'ProductController@recovery');
    Route::get('/showcount', 'ProductController@showcount');
    Route::get('/trash-list', 'ProductController@trashlist');
    Route::get('/delete/{id}', 'ProductController@delete');
    Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::get('/test/{id}', 'ProductController@Test');
});
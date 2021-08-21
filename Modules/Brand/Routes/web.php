<?php

use Illuminate\Support\Facades\Route;

Route::prefix('brand')->group(function() {
    Route::get('/', 'BrandController@index')->name('brand.index');
    Route::post('/', 'BrandController@storeBrand');
    Route::get('/edit/{id:id}', 'BrandController@edit');
    Route::post('/update/{id:id}', 'BrandController@update');
    Route::get('/trash/{id:id}', 'BrandController@moveTrash');
    Route::get('/trash', 'BrandController@trash')->name('brand.trash');
    Route::get('/showcount', 'BrandController@showcount');
    Route::get('/recovery/{id}', 'BrandController@recovery');
    Route::get('/delete/{id}', 'BrandController@delete');
});
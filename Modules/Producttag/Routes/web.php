<?php

use Illuminate\Support\Facades\Route;



Route::prefix('producttag')->group(function() {
    Route::get('/', 'ProducttagController@index')->name('producttag.index');
    Route::post('/', 'ProducttagController@storeTag');
    Route::get('/edit/{id:id}', 'ProducttagController@edit');
    Route::post('/update/{id:id}', 'ProducttagController@update');
    Route::get('/trash/{id:id}', 'ProducttagController@moveTrash');
    Route::get('/trash', 'ProducttagController@trash')->name('producttag.trash');
    Route::get('/showcount', 'ProducttagController@showcount');
    Route::get('/recovery/{id}', 'ProducttagController@recovery');
    Route::get('/delete/{id}', 'ProducttagController@delete');
});
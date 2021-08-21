<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tag')->group(function() {
    Route::get('/', 'TagController@index');
});
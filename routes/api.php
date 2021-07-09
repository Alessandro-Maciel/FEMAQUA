<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'AuthController@login');


    Route::get('/tools', 'API\toolsController@index')->name('tools.index');

    Route::post('/tools', 'API\toolsController@store')->name('tools.store');

    Route::delete('/tools/{id}', 'API\toolsController@destroy')->name('tools.delete');


<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'API\AuthController@login');


Route::group(['middleware' => ['apiJwt']], function () {
    Route::post('auth/logout', 'API\AuthController@logout');

    Route::get('/tools', 'API\toolsController@index')->name('tools.index');

    Route::get('/tools/{id}', 'API\toolsController@show')->name('tools.show');

    Route::post('/tools', 'API\toolsController@store')->name('tools.store');

    Route::delete('/tools/{id}', 'API\toolsController@destroy')->name('tools.delete');
});

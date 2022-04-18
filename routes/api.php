<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'API\AuthController@login');


Route::group(['middleware' => ['apiJwt']], function () {
    Route::post('auth/logout', 'API\AuthController@logout');

    Route::get('/tools', 'API\ToolsController@index')->name('tools.index');

    Route::get('/tools/{id}', 'API\ToolsController@show')->name('tools.show');

    Route::post('/tools', 'API\ToolsController@store')->name('tools.store');

    Route::delete('/tools/{id}', 'API\ToolsController@destroy')->name('tools.delete');
});

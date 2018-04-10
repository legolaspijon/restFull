<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::post('user', 'UserController@create');

    Route::post('user/{user}', 'UserController@update');

    Route::delete('user/{user}', 'UserController@delete');

    Route::get('user/{user}', 'UserController@show');

    Route::get('users', 'UserController@all');

    Route::get('users/search/q/{q}', 'UserController@search');

});


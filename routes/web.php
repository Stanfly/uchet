<?php

use Illuminate\Http\Request;

Route::get('/', ['as' => 'welcome', 'uses' => 'HomeController@welcome']);

Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'TaskController@index']);
    Route::get('/get', ['as' => 'get', 'uses' => 'TaskController@get']);
    Route::put('/', ['as' => 'create', 'uses' => 'TaskController@create']);
    Route::delete('{task}', ['as' => 'delete', 'uses' => 'TaskController@delete']);
});

Route::group(['prefix' => 'houses', 'as' => 'houses.'], function() {
    Route::get('/', ['as' => 'index', 'uses' => 'HouseController@index']);
    Route::put('/', ['as' => 'create', 'uses' => 'HouseController@create']);
    Route::get('{house}', ['as' => 'show', 'uses' => 'HouseController@show']);
    Route::delete('{house}', ['as' => 'delete', 'uses' => 'HouseController@delete']);
});

Auth::routes();


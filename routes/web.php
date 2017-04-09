<?php


Route::get('/', function () {
    return view('tasks');
});
Route::get('/welcome', function () {
    return view('welcome');
});

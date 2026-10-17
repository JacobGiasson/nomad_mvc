<?php
use App\Routes\Route;

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/orders', 'OrderController@index');
Route::get('/order/show', 'OrderController@show');
Route::get('/order/create', 'OrderController@create');
Route::post('/order/create', 'OrderController@store');
Route::get('/order/edit', 'OrderController@edit');
Route::post('/order/edit', 'OrderController@update');
Route::post('/order/delete', 'OrderController@delete');

Route::dispatch();
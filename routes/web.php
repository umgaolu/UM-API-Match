<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/line','ChartController@line');
Route::post('/bar','ChartController@bar');
Route::post('/pie','ChartController@pie');
Route::post('/bubble','ChartController@bubble');
Route::get('/','FilterInputController@index');
Route::view('/welcome', 'welcome');
Route::post('/charts','ChartController@loadFiltered');
Route::get('/show','ChartController@load');
Route::get('/m','MealInputController@index');

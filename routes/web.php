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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/','InventoryController@index');
// Route::get('/','DummyController@index');
Route::get('/c','ChartController@load');
// Route::get('/','ApiController@index');
// Route::get('/','MealController@collectData');
// Route::get('/m','MealController@exportData');
// Route::get('/meals','MealController@collectData');
// Route::get('/charts','ChartController@all');
Route::get('/line','ChartController@line');
Route::get('/bar','ChartController@bar');
Route::get('/pie','ChartController@pie');
Route::get('/bubble','ChartController@bubble');
Route::post('/line','ChartController@line');
Route::post('/bar','ChartController@bar');
Route::post('/pie','ChartController@pie');
Route::post('/bubble','ChartController@bubble');
Route::get('/','FilterInputController@index');
Route::view('/welcome', 'welcome');
Route::post('/charts','ChartController@loadFiltered');
Route::get('/show','ChartController@load');
Route::get('/m','MealInputController@index');
// Route::post('/charts','ChartController@load');

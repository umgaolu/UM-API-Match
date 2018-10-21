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
Route::get('/c','ChartController@index');
// Route::get('/','ApiController@index');
// Route::get('/','MealController@collectData');
Route::get('/','MealController@index');
Route::get('/meals','MealController@collectData');
Route::get('/charts','ChartController@all');

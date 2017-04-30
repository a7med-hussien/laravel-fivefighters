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

Route::get('getAllUsers', 'HomeController@getAllUsers');
Route::get('getUserInfo', 'HomeController@getUserInfo');
Route::put('updateUserInfo', 'HomeController@updateUserInfo');
Route::delete('deleteUser', 'HomeController@deleteUser');
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@store');


Route::post('search', 'HomeController@search');

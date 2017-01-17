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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('books', 'BookController@index');
Route::post('books', 'BookController@store');

Route::get('api/formatTypes', 'BookController@getFormatTypes');
Route::get('api/books', 'BookController@getItemsPaginated');


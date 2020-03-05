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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', 'CallHistoryController@panel')->name('panel');
Route::post('/panel', 'CallHistoryController@dates')->name('panel');

Route::get('/conversations', 'CallHistoryController@index')->name('conversations');

Route::get('/history', 'CallHistoryController@search')->name('history');
Route::post('/history', 'CallHistoryController@show')->name('history');

Route::get('/consulta', 'CallHistoryController@consulta')->name('consulta');
Route::post('/consulta', 'CallHistoryController@consulta')->name('consulta');


/////////////
Route::get('/consulta1', 'CallHistoryController@consulta1')->name('consulta1');
Route::post('/consulta1', 'CallHistoryController@filter')->name('consulta1');
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
Route::get('/home', 'CallHistoryController@views')->name('home');

Route::get('/panel', 'CallHistoryController@panel')->name('panel');
Route::post('/panel', 'CallHistoryController@dates')->name('panel');

Route::get('/tecAdvisors', 'CallHistoryController@tecAdvisors')->name('tecAdvisors');

Route::get('/conversations', 'CallHistoryController@index')->name('conversations');

Route::get('/history', 'CallHistoryController@search')->name('history');
Route::post('/history', 'CallHistoryController@show')->name('history');

Route::get('/consulta', 'CallHistoryController@consulta')->name('consulta');
Route::post('/consulta', 'CallHistoryController@consulta')->name('consulta');

Route::get('/register', 'CallHistoryController@register')->name('register');

Route::get('/admin', 'CallHistoryController@admin')->name('admin');
Route::post('/create', 'CallHistoryController@create')->name('create');
Route::post('/admin', 'CallHistoryController@role')->name('admin');

Route::get('/chat', 'CallHistoryController@chat')->name('chat');


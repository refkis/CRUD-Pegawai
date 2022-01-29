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

Route::prefix('pegawai')->group(function () {
    Route::get('/', 'PegawaiController@index');
    Route::get('/{id}', 'PegawaiController@get');
    Route::post('/insert', 'PegawaiController@insert');
    Route::post('/update', 'PegawaiController@update');
    Route::get('/delete/{id}', 'PegawaiController@delete');
});

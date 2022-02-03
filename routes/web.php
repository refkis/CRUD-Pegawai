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
    return view('auth.login');
});

Route::post('/postlogin','AuthController@postlogin' );
Route::get('/login','AuthController@login' )->name('login') ;
Route::get('/logout','AuthController@logout' );

Route::prefix('pegawai')->middleware('auth')->group(function () {
    Route::get('/', 'PegawaiController@index');
    Route::get('/dt', 'PegawaiController@datatable');
    Route::get('/cetak', 'PegawaiController@cetak');
    Route::post('/insert', 'PegawaiController@insert');
    Route::post('/update', 'PegawaiController@update');
    Route::get('/{id}', 'PegawaiController@get');
    Route::get('/delete/{id}', 'PegawaiController@delete');
});

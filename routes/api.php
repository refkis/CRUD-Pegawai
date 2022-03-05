<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix'=>'pegawai'], function(){
    Route::get('/all','ApiController@get_data');
    Route::get('/id/','ApiController@get_id');
    Route::post('/insert','ApiController@insert');
    Route::get('/list','ApiController@get_list');
    Route::post('/update/','ApiController@update');
});

Route::post('login','AuthApiController@postLogin');



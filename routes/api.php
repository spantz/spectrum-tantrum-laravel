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

Route::group(['middleware' => ['authenticateAPI', 'log']], function(){
    Route::post('/tests', 'TestController@logSpeed');
});

Route::post('/registerDevice/{token}', 'API\RegisterDeviceController@registerDevice');
Route::get('/ping/{token}', 'API\PingController@verifyToken');
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

use App\Http\RouteConstants;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')
        ->name(RouteConstants::HOME);

    Route::get('/devices', 'HomeController@deviceRegistration')
        ->name(RouteConstants::DEVICE_REGISTRATION);

    Route::get('/dashboard', 'DashboardController@index');
});

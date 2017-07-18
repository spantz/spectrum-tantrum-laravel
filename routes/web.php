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

use App\Http\RouteUtils;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name(RouteUtils::HOME);

Route::get('/devices/register', function () {
    dd('Device registration page!');
})->name(RouteUtils::DEVICE_REGISTRATION);

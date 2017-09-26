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


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name(RouteConstants::LOGIN);
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name(RouteConstants::LOGOUT);

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name(RouteConstants::REGISTER);
Route::post('register', 'Auth\RegisterController@register');

Route::middleware('auth')->group(function () {

    Route::get('/devices/register', 'HomeController@deviceRegistration')
        ->name(RouteConstants::DEVICE_REGISTRATION);

    Route::get('/devices', function () {
        return redirect()->route(RouteConstants::DEVICE_REGISTRATION);
    });

    Route::group(['prefix' => '/dashboard'], function () {
        Route::get('/', 'DashboardController@index')
            ->name(RouteConstants::DASHBOARD);
        Route::get('/aggregates', 'DashboardController@aggregates');
    });
});

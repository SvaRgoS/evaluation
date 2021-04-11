<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth', 'namespace' => '\App\Http\Controllers\Api\Auth'], function () {
    Route::post(
        'sign-in',
        'SignInController@signIn'
    );
    Route::post(
        'sign-up',
        'SignUpController@signUp'
    );
});

Route::group(['middleware' => 'auth:api', 'namespace' => '\App\Http\Controllers\Api'], function () {
    Route::resource(
        '/contact',
        'ContactController'
    );
    Route::resource(
        '/profile',
        'ContactController'
    )->only('update');
});


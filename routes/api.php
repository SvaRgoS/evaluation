<?php

use Illuminate\Http\Request;
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
        'login',
        'LoginController@login'
    );
});


Route::middleware('auth:api')->resource(
    '/contact',
    \App\Http\Controllers\Api\ContactController::class
);


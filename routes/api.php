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

Route::group(
    ['middleware' => 'api', 'namespace' => '\App\Http\Controllers\Api'],
    function ($route) {
        $route->group(['prefix' => 'auth'],
            function () {
                Route::post('sign-in', 'AuthController@signIn');
                Route::post('sign-up', 'AuthController@signUp');
                Route::get('sign-out', 'AuthController@signOut');
                Route::get('refresh', 'AuthController@refresh');
                Route::patch('profile/{user}', 'AuthController@update');
            });
        Route::resource('/contact', 'ContactController');
    }
);

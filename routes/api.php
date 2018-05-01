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

Route::post('/register', 'Api\ApiAuthController@register')->name('api.register');
Route::post('/login/refresh', 'Api\ApiAuthController@refresh')->name('api.login.refresh');
Route::post('/login', 'Api\ApiAuthController@authenticate')->name('api.login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	// return 'asdasd';
    return $request->user();
});

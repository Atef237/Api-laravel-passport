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

    /*
        route::post('login','Api\loginCon@login');
        route::post('register','Api\loginCon@register');
    */


route::post('login','Api\loginCon@login');

route::get('user','Api\loginCon@user')->middleware('auth:api');

route::post('forgot','Api\forgotCon@forgot');

route::post('reset','Api\resetPasswordController@reset');

route::post('register','Api\loginCon@register');

route::get('logout','loginCon@logout');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

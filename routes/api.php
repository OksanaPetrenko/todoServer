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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
});
Route::group([
    'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::group(['prefix' => 'task'], function () {
            Route::get('{id}/get', 'Api\TaskController@getTask');
            Route::get('all', 'Api\TaskController@getTasksUser');
            Route::post('create', 'Api\TaskController@createTask');
            Route::post('{id}/update', 'Api\TaskController@updateTask');
            Route::delete('{id}/delete', 'Api\TaskController@deleteTaskUser');
        });
    });
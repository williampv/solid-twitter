<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('api')->group( function () {
    Route::apiResource('tweets', 'TweetController');
    Route::apiResource('tweets/{id}/like', 'LikeController');
    Route::apiResource('users/{id}/like', 'UserController');
    Route::get('account', 'AccountController@index');
});

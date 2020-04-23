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

Auth::routes();

// Authorized Routes
Route::group(['middleware' => ['web']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('api/v1/user', 'UserController@index');
    Route::get('api/v1/following', 'UserController@following');
    Route::post('api/v1/following', 'UserController@follow');
    Route::post('api/v1/unfollow', 'UserController@unfollow');
});

// Open routes
Route::group(['middleware' => ['web']], function () {
});

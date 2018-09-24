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

//Route::get('/', function () {
//    return view('index');
//});

Route::get('/', function () {
    return view('index');
});

//Route::group(['prefix' => 'auth'], function ($router) {
//    Route::post('login', 'AuthController@login')->name('login');
//    Route::get('chucnang', 'AuthController@get_list_chuc_nang');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');
//});
//
//Route::get('/', 'HomeController@getIndex');
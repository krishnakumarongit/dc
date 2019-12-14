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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/post-ad', 'DashboardController@index')->name('ad');
Route::any('/ad', 'DashboardController@stepOne')->name('post.ad');
Route::any('/post-location/{id}', 'DashboardController@stepTwo')->name('post.location');


Route::any('/getdistrict', 'DashboardController@getdistrict')->name('post.getdistrict');
Route::any('/getlocation', 'DashboardController@getlocation')->name('post.getlocation');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

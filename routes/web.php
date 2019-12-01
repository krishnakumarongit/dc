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

Route::any('/add', 'DashboardController@index')->name('add');
Route::any('/add/{id}', 'DashboardController@index')->name('add.param');
Route::any('/addlocation/{id}', 'DashboardController@location')->name('add.location');
Route::any('/addimage/{id}', 'DashboardController@image')->name('add.image');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

// login
Route::get('/','LoginController@index');
Route::post('/auth','LoginController@auth');

// dashboard
Route::get('/beranda','DashboardController@index');

// banner
Route::get('/data-banner','DashboardController@getBanner');
Route::post('/add-banner','BannerController@store');
Route::post('/update-banner/{id}','BannerController@update');
Route::get('/delete-banner/{id}','BannerController@destroy');

// video
Route::get('/data-video','DashboardController@getVideo');
Route::post('/add-video','VideoController@store');
Route::post('/update-video/{id}','VideoController@update');
Route::get('/delete-video/{id}','VideoController@destroy');

// iklan
Route::get('/data-iklan/{id}','DashboardController@getIklan');
Route::post('/add-ads','AdsController@store');
Route::post('/update-ads/{id}','AdsController@update');
Route::get('/delete-ads/{id}','AdsController@destroy');
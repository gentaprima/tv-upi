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
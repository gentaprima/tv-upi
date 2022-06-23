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

// banner
Route::get('/get-banner','BannerController@getBanner');

// video
Route::get('/get-video/{jenis}','VideoController@getVideo');
Route::get('/get-video-selection','VideoController@getVideoSelection');
Route::get('/add-count/{id}','VideoController@addCount');

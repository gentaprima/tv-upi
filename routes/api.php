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


// Ads
Route::get('/get-ads/{jenis}','AdsController@getAds');
Route::get('/get-ads-beranda/{jenis}/{position}','AdsController@getAdsBeranda');

// jadwal siaran
Route::get('/jadwal-siaran/{hari}','JadwalSiaranController@getJadwalSiaran');

// berita
Route::get('/get-kategori-berita','KategoriBeritaController@getKategori');
Route::get('/get-latest-news','BeritaController@getLatestNews');
Route::get('/get-news','BeritaController@getNews');
Route::get('/add-like-news/{idUsers}/{idBerita}','BeritaController@addLike');

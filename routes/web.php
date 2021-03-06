<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
Route::get('/', 'LoginController@index');
Route::post('/auth', 'LoginController@auth');

Route::group(['middleware' => 'check.login', 'prefix' => '/'], function () {
    // dashboard
    Route::get('/beranda', 'DashboardController@index');

    // banner
    Route::get('/data-banner', 'DashboardController@getBanner');
    Route::post('/add-banner', 'BannerController@store');
    Route::post('/update-banner/{id}', 'BannerController@update');
    Route::get('/delete-banner/{id}', 'BannerController@destroy');
    Route::get('/show-banner-json','BannerController@getBannerJson');

    // video
    Route::get('/data-video', 'DashboardController@getVideo');
    Route::post('/add-video', 'VideoController@store');
    Route::post('/update-video/{id}', 'VideoController@update');
    Route::get('/delete-video/{id}', 'VideoController@destroy');
    Route::get('/show-video-json','VideoController@getVideoJson');

    // iklan
    Route::get('/data-iklan/{id}', 'DashboardController@getIklan');
    Route::post('/add-ads', 'AdsController@store');
    Route::post('/add-new-ads', 'AdsController@addData');
    Route::post('/update-ads/{id}', 'AdsController@update');
    Route::get('/delete-ads/{id}', 'AdsController@destroy');
    Route::get('/show-ads-json/{id}','AdsController@getAdsJson');

    // berita & kategori
    Route::get('/data-kategori-berita', 'DashboardController@getKategoriBerita');
    Route::post('add-kategori-berita', 'KategoriBeritaController@store');
    Route::post('update-kategori-berita/{id}', 'KategoriBeritaController@update');
    Route::get('delete-kategori-berita/{id}', 'KategoriBeritaController@destroy');
    Route::get('/data-berita', 'DashboardController@getBerita');
    Route::post('/add-berita', 'BeritaController@store');
    Route::post('/update-berita/{id}', 'BeritaController@update');
    Route::get('/delete-berita/{id}', 'BeritaController@destroy');
    Route::get('/show-berita/{id}', 'BeritaController@show');
    Route::get('/show-berita-json','BeritaController@getBeritaJson');

    // jadwal siaran
    Route::get('/jadwal-siaran', 'DashboardController@jadwalSiaran');
    Route::get('/ubah-siaran/{id}', 'DashboardController@ubahSiaran');
    Route::post('/add-jadwal-siaran', 'JadwalSiaranController@store');
    Route::post('/update-jadwal-siaran/{id}', 'JadwalSiaranController@update');
    Route::get('/delete-jadwal-siaran/{id}', 'JadwalSiaranController@destroy');
    Route::get('/jadwal-siaran-show/{id}', 'JadwalSiaranController@show');

    Route::get('/profile','DashboardController@profile');
    Route::post('/update-profile/{id}/{form}','UsersController@updateProfile');
    Route::get('/data-pengguna','DashboardController@dataUsers');
    Route::post('/add-users','UsersController@addUsers');
    Route::get('/delete-users/{id}','UsersController@destroy');
    Route::get('/test','DashboardController@test');

    Route::get('/logout', function () {
        Session::flush();
        return redirect('/');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use Whoops\Run;

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

Route::get('/test','DashboardController@test');

// berita & kategori
Route::get('/data-kategori-berita','DashboardController@getKategoriBerita');
Route::post('add-kategori-berita','KategoriBeritaController@store');
Route::post('update-kategori-berita/{id}','KategoriBeritaController@update');
Route::get('delete-kategori-berita/{id}','KategoriBeritaController@destroy');
Route::get('/data-berita','DashboardController@getBerita');
Route::post('/add-berita','BeritaController@store');
Route::post('/update-berita/{id}','BeritaController@update');
Route::post('/delete-berita/{id}','BeritaController@destroy');
Route::get('/show-berita/{id}','BeritaController@show');
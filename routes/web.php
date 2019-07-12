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
Auth::routes();
//Route Admin
Route::prefix('adm1n')->group(function () {
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/index', 'AdminController@index')->name('admin.dashboard');
  Route::get('/', 'AdminController@index');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


  Route::get('/kelola-pegawai', 'KelolaPegawaiController@index')->name('admin.kelola-pegawai');
  Route::post('/kelola-pegawai/tambah', 'KelolaPegawaiController@store')->name('admin.tambah-pegawai');
  Route::post('/kelola-pegawai/hapus', 'KelolaPegawaiController@destroy')->name('admin.hapus-pegawai');
});

Route::get('/', 'Auth\LoginController@ShowLoginForm');

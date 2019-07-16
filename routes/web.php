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
  Route::post('/index/validasi-pegawai', 'AdminController@validasi_pegawai')->name('admin.validasi-pegawai');
  Route::get('/', 'AdminController@index');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

  Route::get('/profil','AdminController@show_profil')->name('admin.show-profil');
  Route::post('/profil','AdminController@update_profil')->name('admin.update-profil');

  Route::get('/kelola-pegawai', 'KelolaPegawaiController@index')->name('admin.kelola-pegawai');
  Route::post('/kelola-pegawai/tambah', 'KelolaPegawaiController@store')->name('admin.tambah-pegawai');
  Route::post('/kelola-pegawai/hapus', 'KelolaPegawaiController@destroy')->name('admin.hapus-pegawai');
  Route::get('/kelola-pegawai/{id}', 'KelolaPegawaiController@show');
  Route::post('/kelola-pegawai/update', 'KelolaPegawaiController@update')->name('admin.update-pegawai');
  Route::post('/kelola-pegawai/reset-password', 'KelolaPegawaiController@reset_password')->name('admin.reset-password-pegawai');

  Route::get('/surat-ukur', 'SuratUkurController@index')->name('admin.surat-ukur');
  Route::get('/surat-ukur/daftar-kelurahan', 'SuratUkurController@get_kelurahan')->name('admin.hapus-surat');
  Route::get('/surat-ukur/tambah-surat', 'SuratUkurController@create')->name('admin.tambah-surat-ukur');
  Route::post('/surat-ukur/tambah-surat', 'SuratUkurController@store')->name('admin.tambah-surat-ukur');
  Route::post('/surat-ukur/hapus', 'SuratUkurController@hapus')->name('admin.hapus-surat');
  Route::post('/surat-ukur/update/{id}', 'SuratUkurController@update');
  Route::get('/surat-ukur/{id}', 'SuratUkurController@show');

  Route::get('/wilayah', 'WilayahController@index')->name('admin.wilayah');
  Route::post('/wilayah/hapus-kecamatan', 'WilayahController@delete_kecamatan')->name('admin.hapus-kecamatan');
  Route::post('/wilayah/hapus-kelurahan', 'WilayahController@delete_kelurahan')->name('admin.hapus-kelurahan');

  Route::post('/wilayah/tambah-kecamatan', 'WilayahController@tambah_kecamatan')->name('admin.tambah-kecamatan');
  Route::post('/wilayah/tambah-kelurahan', 'WilayahController@tambah_kelurahan')->name('admin.tambah-kelurahan');
  
  Route::get('/pinjaman', 'PinjamanController@index')->name('admin.pinjaman');
  Route::post('/pinjaman/batas-akhir', 'PinjamanController@update_batas_akhir')->name('admin.update-batas-pinjaman');
  Route::post('/pinjaman/update-status', 'PinjamanController@update_status_pinjaman')->name('admin.update-status-pinjaman');
  Route::post('/pinjaman/pinjaman-selesai', 'PinjamanController@pinjaman_selesai')->name('admin.update-pinjaman-selesai');
});

Route::prefix('')->group(function () {
  Route::get('/', 'Auth\PegawaiLoginController@ShowLoginForm')->name('pegawai.login');
  Route::get('/logout', 'Auth\PegawaiLoginController@logout')->name('pegawai.logout');
  Route::post('/login', 'Auth\PegawaiLoginController@login')->name('pegawai.login.submit');
  Route::get('/surat-ukur', 'PegawaiController@surat_ukur')->name('pegawai.surat-ukur');
  Route::get('/surat-ukur/{id}', 'PegawaiController@detail_surat_ukur');
  Route::post('/surat-ukur/pinjam', 'PegawaiController@pinjam_surat')->name('pegawai.pinjam-surat');
  Route::get('/pinjaman','PegawaiController@show_pinjaman')->name('pegawai.show_pinjaman');
  Route::get('/daftar',function(){
    return view('pegawai.daftar');
  })->name('pegawai.daftar');
  Route::post('/daftar','Auth\PegawaiLoginController@register')->name('pegawai.daftar-submit');
  Route::get('/cari','PegawaiController@search_berkas')->name('pegawai.search-berkas');
  Route::get('/profil','PegawaiController@show_profil')->name('pegawai.show-profil');
  Route::post('/profil','PegawaiController@update_profil')->name('pegawai.update-profil');
});
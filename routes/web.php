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
use App\User;
use App\Stasiun;


Auth::routes();
Route::get('/dashboard','DashboardController@cekUser');
Route::get('/{val}','DashboardController@index');
Route::get('/','DashboardController@index');

//User
Route::get('/user','UserController@lihat');
Route::post('/user/tambah','UserController@tambah');
Route::post('/user/edit','UserController@editView')->name('user.edit');
Route::post('/user/edited','UserController@edit')->name('user.edit');
Route::post('/user/cektombol','UserController@cektombol');

//Stasiun
Route::get('/stasiun','StasiunController@indexStasiun');
Route::post('/stasiun/tambah','StasiunController@tambah');
Route::post('/stasiun/cektombol','StasiunController@cektombol');
Route::post('/stasiun/edit','StasiunController@edit');
Route::post('/stasiun/delete','StasiunController@hapus');

//Stasiun Penumpang
Route::get('/stasiun/penumpang/tambah','StasiunController@viewStasiunPenumpang');
Route::post('/stasiun/penumpang/tambah','StasiunController@tambahStasiunPenumpang');
Route::post('/stasiun/penumpang/cektombol','StasiunController@cekTombolPenumpang');
Route::post('/stasiun/penumpang/edit','StasiunController@editStasiunPenumpang');
Route::post('/stasiun/penumpang/delete','StasiunController@hapusStasiunPenumpang');

//Stasiun Barang
Route::get('/stasiun/barang/tambah','StasiunController@viewStasiunBarang');
Route::post('/stasiun/barang/tambah','StasiunController@tambahStasiunBarang');
Route::post('/stasiun/barang/cektombol','StasiunController@cekTombolBarang');
Route::post('/stasiun/barang/edit','StasiunController@editStasiunBarang');
Route::post('/stasiun/barang/delete','StasiunController@hapusStasiunBarang');

//Penumpang
Route::get('/penumpang/tambah','PenumpangController@indexPenumpang');
Route::post('/penumpang/tambah','PenumpangController@tambah');
Route::get('/penumpang/lihat','PenumpangController@lihat');
Route::post('/penumpang/lihat','PenumpangController@lihat');
Route::post('/penumpang/lihat/cektombol','PenumpangController@cekTombol');
Route::get('/penumpang/lihat/detail','PenumpangController@lihatDetail');
Route::post('/penumpang/lihat/detail','PenumpangController@lihatDetail');
Route::get('/penumpang/komulatif','PenumpangController@lihatKomulatif');
Route::post('/penumpang/komulatif','PenumpangController@lihatKomulatif');
Route::get('/penumpang/lihat/edit','PenumpangController@viewedit');
Route::post('/penumpang/lihat/edit','PenumpangController@viewedit');
Route::post('/penumpang/edit','PenumpangController@edit');
Route::post('/penumpang/get/stasiun','PenumpangController@getStasiun');
//Route Barang
Route::get('/barang/tambah','BarangController@viewTambah');
Route::post('/barang/tambah','BarangController@tambah');
Route::get('/barang/lihat','BarangController@lihatData');
Route::post('/barang/lihat','BarangController@lihatData');
Route::get('/barang/komulatif','BarangController@lihatKomulatif');
Route::post('/barang/komulatif','BarangController@lihatKomulatif');
Route::get('/barang/lihat/edit','BarangController@viewedit');
Route::post('/barang/lihat/edit','BarangController@viewedit');
Route::post('/barang/edit','BarangController@edit');
//Route Bhp
Route::get('/barang/bhp/tambah','BhpController@viewTambah');
Route::post('/barang/bhp/tambah','BhpController@tambah');
Route::get('/barang/bhp/lihat','BhpController@lihatData');
Route::post('/barang/bhp/lihat','BhpController@lihatData');
Route::get('/barang/bhp/lihat/edit','BhpController@viewEdit');
Route::post('/barang/bhp/edit','BhpController@edit');
Route::post('/barang/bhp/cektombol','BhpController@cekTombol');
Route::post('/barang/bhp/get/stasiun','BhpController@getStasiun');
//route pendapatan Ambarawa
Route::get('/ambarawa/tambah','NonAngkutanController@indexAmbarawa');
Route::post('/ambarawa/tambah','NonAngkutanController@tambahAmbarawa');
Route::get('/ambarawa/lihat/edit','NonAngkutanController@vieweditambarawa');
Route::post('/ambarawa/lihat/edit','NonAngkutanController@vieweditambarawa');
Route::post('/ambarawa/edit','NonAngkutanController@editambarawa');


//route pendapatan lawang
Route::get('/lawang/tambah','NonAngkutanController@indexLawangSewu');
Route::post('/lawang/tambah','NonAngkutanController@tambahLawangSewu');
Route::get('/lawang/lihat/edit','NonAngkutanController@vieweditLawang');
Route::post('/lawang/lihat/edit','NonAngkutanController@vieweditLawang');
Route::post('/lawang/edit','NonAngkutanController@editLawang');

//route pendapatan PA
Route::get('/pa/tambah','NonAngkutanController@indexpa');
Route::post('/pa/tambah','NonAngkutanController@tambahpa');
Route::get('/pa/lihat/edit','NonAngkutanController@vieweditPa');
Route::post('/pa/lihat/edit','NonAngkutanController@vieweditPa');
Route::post('/pa/edit','NonAngkutanController@editPa');

//route pendapatan PA
Route::get('/uuk/tambah','NonAngkutanController@indexuuk');
Route::post('/uuk/tambah','NonAngkutanController@tambahuuk');
Route::get('/uuk/lihat/edit','NonAngkutanController@viewedituuk');
Route::post('/uuk/lihat/edit','NonAngkutanController@viewedituuk');
Route::post('/uuk/edit','NonAngkutanController@edituuk');


//Route Non Angkutan
Route::get('/nonangkutan/lihat/harian','NonAngkutanController@lihatData');
Route::post('/nonangkutan/lihat/harian','NonAngkutanController@lihatData');

//Route Cek Tombol
Route::post('/nonangkutan/lihat/cektombolpa','NonAngkutanController@cekTombolPA');
Route::post('/nonangkutan/lihat/cektomboluuk','NonAngkutanController@cekTombolUUK');
Route::post('/nonangkutan/lihat/cektombolambarawa','NonAngkutanController@cekTombolAmbarawa');
Route::post('/nonangkutan/lihat/cektombollawang','NonAngkutanController@cekTombolLawang');

//route lihat Lawang dan ambbarawa
Route::post('/nonangkutan/lihat/lawang','NonAngkutanController@lihatlawangsewu');
Route::post('/nonangkutan/lihat/ambarawa','NonAngkutanController@lihatambarawa');

// nonangkutan/lihat/komulatif
Route::get('/nonangkutan/lihat/komulatif','NonAngkutanController@lihatDataKomulatif');
Route::post('/nonangkutan/lihat/komulatif','NonAngkutanController@lihatDataKomulatif');

//Target
Route::get('/target','TargetController@viewTambahTarget');
Route::get('/target/edit','TargetController@viewEditTarget');
Route::post('/target/edit','TargetController@viewEditTarget');
Route::post('/target/tambah','TargetController@tambah');
Route::get('/target/lihat','TargetController@viewTarget');
Route::post('/target/lihat','TargetController@viewTarget');
Route::post('/target/edited','TargetController@edit');
//route harian
Route::get('/laporan/harian','KomulatifController@viewRekapHarian');
Route::post('/laporan/harian','KomulatifController@viewRekapHarian');
//route rekap
Route::get('/laporan/komulatif','KomulatifController@viewRekapKomulatif');
Route::post('/laporan/komulatif','KomulatifController@viewRekapKomulatif');
//route ka daop
Route::get('/laporan/kadaop','KomulatifController@viewRekapKaDaop');
Route::post('/laporan/kadaop','KomulatifController@viewRekapKaDaop');
Route::get('/laporan/chart',function(){
	return view('chart');
});
//route download
Route::post('/laporan/export/harian','ExcelController@exportLaporanHarian');
Route::post('/laporan/export/komulatif','ExcelController@exportLaporanKomulatif');
Route::post('/laporan/export/kadaop','ExcelController@exportLaporanKaDaop');

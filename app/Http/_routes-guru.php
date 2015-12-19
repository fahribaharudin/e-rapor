<?php 

/*
 |----------------------------------------------------------------
 | Guru Routes
 |----------------------------------------------------------------
 |
 | Pada file ini terdapat semua routes milik guru. 
 | Tentu saja routes yang di definisikan disini sudah tersaring 
 | oleh middleware milik guru, jadi router yang ada disini hanya
 | bisa di akses oleh guru dan sudah secure :)
 |
 */

Route::get('/guru', ['as' => 'guru', 'uses' => 'Guru\GuruController@index']);
Route::get('/guru/kelas', ['as' => 'guru.kelas.index', 'uses' => 'Guru\KelasController@index']);
Route::get('/guru/kelas/siswa', ['as' => 'guru.kelas.siswa.index', 'uses' => 'Guru\SiswaController@index']);
Route::get('/guru/kelas/mapel', ['as' => 'guru.kelas.mapel.index', 'uses' => 'Guru\MapelController@index']);


# Nilai pengetahuan routes...
Route::get('/guru/mapel/nilai-pengetahuan', [
	'as' => 'guru.mapel.nilai-pengetahuan.index', 
	'uses' => 'Guru\NilaiPengetahuanController@index'
]);

Route::get('/guru/mapel/{mapel_id}/nilai-pengetahuan/kelas/{kelas}/semester/{semester}', [
	'as' => 'guru.mapel.nilai-pengetahuan.kelas.index',
	'uses' => 'Guru\NilaiPengetahuanController@indexByKelas'
]);

Route::get('/guru/mapel/{mapel_id}/nilai-pengetahuan/kelas/{kelas}/semester/{semester}/siswa/{siswa_id}/edit', [
	'as' => 'guru.nilai-pengetahuan.edit',
	'uses' => 'Guru\NilaiPengetahuanController@edit'
]);

Route::put('/guru/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan', [
	'as' => 'guru.nilai-pengetahuan.update',
	'uses' => 'Guru\NilaiPengetahuanController@update'
]);


# Nilai sikap routes...
Route::get('/guru/mapel/nilai-sikap', [
	'as' => 'guru.mapel.nilai-sikap',
	'uses' => 'Guru\NilaiSikapController@index'
]);

Route::get('/guru/mapel/{mapel_id}/nilai-sikap/kelas/{kelas}/semester/{semester}', [
	'as' => 'guru.mapel.nilai-sikap.index',
	'uses' => 'Guru\NilaiSikapController@indexByMapel'
]);

Route::get('/guru/mapel/{mapel_id}/nilai-sikap/kelas/{kelas}/semester/{semester}/siswa/{siswa_id}/edit', [
	'as' => 'guru.mapel.nilai-sikap.edit',
	'uses' => 'Guru\NilaiSikapController@edit'
]);

Route::put('/guru/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-sikap', [
	'as' => 'guru.mapel.nilai-sikap.update',
	'uses' => 'Guru\NilaiSikapController@update'
]);


# Nilai keterampilan routes...
Route::get('/guru/mapel/nilai-keterampilan', [
	'as' => 'guru.mapel.nilai-keterampilan',
	'uses' => 'Guru\NilaiKeterampilanController@index'
]);

Route::get('/guru/mapel/{mapel_id}/nilai-keterampilan/kelas/{kelas}/semester/{semester}', [
	'as' => 'guru.mapel.nilai-keterampilan.index',
	'uses' => 'Guru\NilaiKeterampilanController@indexByMapel'
]);

Route::get('/guru/mapel/{mapel_id}/nilai-keterampilan/kelas/{kelas}/semester/{semester}/siswa/{siswa_id}/edit', [
	'as' => 'guru.mapel.nilai-keterampilan.edit',
	'uses' => 'Guru\NilaiKeterampilanController@edit'
]);

Route::put('/guru/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-keterampilan', [
	'as' => 'guru.mapel.nilai-keterampilan.update',
	'uses' => 'Guru\NilaiKeterampilanController@update'
]);


# Admin raport routes...
Route::get('/guru/raport/search', ['as' => 'guru.raport.index', 'uses' => 'Guru\RaporController@index']);
Route::get('/guru/raport/kelas/{kelas_id}/semester/{semester}', [
	'as' => 'guru.raport.indexByKelas', 
	'uses' => 'Guru\RaporController@indexByKelas'
]);
Route::get('/guru/raport/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}', [
	'as' => 'guru.raport.indexBySiswa', 
	'uses' => 'Guru\RaporController@indexBySiswa'
]);

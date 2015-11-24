<?php 

/*
 |----------------------------------------------------------------
 | Administrator Routes
 |----------------------------------------------------------------
 |
 | Pada file ini terdapat semua routes milik administrator. 
 | Tentu saja routes yang di definisikan disini sudah tersaring 
 | oleh middleware milik admin, jadi router yang ada disini hanya
 | bisa di akses oleh admin dan sudah secure :)
 |
 */



# Admin Dashboard routes...
Route::get('/admin', ['as' => 'admin', 'uses' => 'Admin\AdminController@getIndex']);

Route::resource('/admin/users', 'Admin\UserController', ['only' => ['index', 'create', 'store']]);
Route::resource('/admin/profile-sekolah', 'Admin\ProfileSekolahController', ['only' => 'index']);
Route::resource('/admin/paket-keahlian', 'Admin\PaketKeahlianController', ['only' => 'index']);
Route::resource('/admin/guru', 'Admin\GuruController', ['only' => 'index']);
Route::get('/admin/guru-ajax', 'Admin\GuruController@indexAjaxFeed');
Route::resource('/admin/siswa', 'Admin\SiswaController', ['only' => 'index']);
Route::resource('/admin/kelas', 'Admin\KelasController', ['only' => 'index']);
Route::resource('/admin/siswa-kelas', 'Admin\SiswaPerKelasController', ['only' => 'index']);



# Admin mapel routes...
Route::resource('/admin/mapel', 'Admin\MapelController', ['only' => ['index', 'edit', 'update']]);
Route::get('/admin/paket/{paket_id}/mapel', [
	'as' => 'admin.mapel.paket.index' ,
	'uses' => 'Admin\MapelController@indexByPaket'
]);



# Admin kompetensi routes...
Route::resource('/admin/kompetensi-dasar', 'Admin\KompetensiController', ['only' => 'index']);
Route::get('/admin/mapel/{mapel_id}/kompetensi-dasar', [
	'as' => 'admin.kompetensi-dasar.mapel.index', 
	'uses' => 'Admin\KompetensiController@indexByMapel'
]);



# Admin mapel - SelectBoxFeeder (Ajax request) routes...
# Digunakan hanya untuk feeding ajax... 
Route::get('/admin/mapel/select-box-feed/bidang', [
	'as' => 'admin.mapel.select-box-feed.bidang', 
	'uses' => 'Admin\MapelController@selectBoxFeedBidang'
]);
Route::get('/admin/mapel/select-box-feed/program/{bidang_id}', [
	'as' => 'admin.mapel.select-box-feed.program', 
	'uses' => 'Admin\MapelController@selectBoxFeedProgram'
]);
Route::get('/admin/mapel/select-box-feed/paket/{program_id}', [
	'as' => 'admin.mapel.select-box-feed.paket',  
	'uses' => 'Admin\MapelController@selectBoxFeedPaket'
]);
Route::get('/admin/kompetensi-dasar/select-box-feed/mapel/{paket_id}', [
	'as' => 'admin.kompetensi-dasar.select-box-feed.mapel', 
	'uses' => 'Admin\MapelController@selectBoxFeedMapel'
]);



# Admin nilai-pengetahuan routes...
Route::resource('/admin/nilai-pengetahuan', 'Admin\NilaiPengetahuanController', ['only' => ['index']]);
Route::get('/admin/nilai-pengetahuan/dropdown/kelas', [
	'as' => 'admin.nilai-pengetahuan.dropdown.kelas', 
	'uses' => 'Admin\NilaiPengetahuanController@kelasDropDown'
]);
Route::get('/admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester', [
	'as' => 'admin.nilai-pengetahuan.dropdown.semester', 
	'uses' => 'Admin\NilaiPengetahuanController@semesterFromKelasDropDown'
]);
Route::get('/admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester/{semester}/mapel', [
	'as' => 'admin.nilai-pengetahuan.dropdown.semester.mapel', 
	'uses' => 'Admin\NilaiPengetahuanController@mapelFromSemesterFromKelas'
]);
Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-pengetahuan', [
	'as' => 'admin.nilai-pengetahuan.index-byMapel', 
	'uses' => 'Admin\NilaiPengetahuanController@indexByMapel'
]);
Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan/edit', [
	'as' => 'admin.nilai-pengetahuan.edit', 
	'uses' => 'Admin\NilaiPengetahuanController@edit'
]);
Route::put('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan', [
	'as' => 'admin.nilai-pengetahuan.update', 
	'uses' => 'Admin\NilaiPengetahuanController@update'
]);



# Admin nilai-keterampilan routes...
Route::resource('/admin/nilai-keterampilan', 'Admin\NilaiKeterampilanController', ['only' => ['index']]); 
Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-keterampilan', [
	'as' => 'admin.nilai-keterampilan.index-byMapel', 
	'uses' => 'Admin\NilaiKeterampilanController@indexByMapel'
]);
Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-keterampilan/edit', [
	'as' => 'admin.nilai-keterampilan.edit', 
	'uses' => 'Admin\NilaiKeterampilanController@edit'
]);
Route::put('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-keterampilan', [
	'as' => 'admin.nilai-keterampilan.update', 
	'uses' => 'Admin\NilaiKeterampilanController@update'
]);



# Admin nilai-sikap routes...
Route::resource('/admin/nilai-sikap', 'Admin\NilaiSikapController', ['only' => ['index']]); 
Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-sikap', [
	'as' => 'admin.nilai-sikap.index-byMapel', 
	'uses' => 'Admin\NilaiSikapController@indexByMapel'
]);
Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-sikap/edit', [
	'as' => 'admin.nilai-sikap.edit', 
	'uses' => 'Admin\NilaiSikapController@edit'
]);
Route::put('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-sikap', [
	'as' => 'admin.nilai-sikap.update', 
	'uses' => 'Admin\NilaiSikapController@update'
]);



# Admin raport routes...
Route::get('/admin/raport/search', ['as' => 'admin.raport.index', 'uses' => 'Admin\RaporController@index']);
Route::get('/admin/raport/kelas/{kelas_id}/semester/{semester}', [
	'as' => 'admin.raport.indexByKelas', 
	'uses' => 'Admin\RaporController@indexByKelas'
]);
Route::get('/admin/raport/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}', [
	'as' => 'admin.raport.indexBySiswa', 
	'uses' => 'Admin\RaporController@indexBySiswa'
]);



# Admin import / export data routes...
Route::get('/admin/data/import', ['as' => 'admin.data.import', 'uses' => 'Admin\DataController@index']);
# (Data akademik)
Route::get('/admin/data/export-akademik', [
	'as' => 'admin.data.export.akademik', 
	'uses' => 'Admin\DataController@exportAkademik'
]);
Route::post('/admin/data/import-akademik', [
	'as' => 'admin.data.import.akademik', 
	'uses' => 'Admin\DataController@importAkademik'
]);
# (Data siswa)
Route::get('/admin/data/export-data-siswa', [
	'as' => 'admin.data.export.siswa',
	'uses' => 'Admin\DataController@exportSiswa'
]);
Route::post('/admin/data/import-data-siswa', [
	'as' => 'admin.data.import.siswa',
	'uses' => 'Admin\DataController@importSiswa'
]);
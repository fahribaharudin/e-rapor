<?php 

# Landing Page
Route::get('/', ['as' => 'landing-page', 'uses' => 'GuestController@getLandingPage']);

# Authentication Routes...
Route::get('/auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/auth/login', ['as' => 'auth.login-post', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);
	
# Authenticated Routes...
Route::group(['middleware' => 'auth'], function() {
	
	# Administrator Routes...
	Route::group(['middleware' => 'admin'], function() {
		Route::get('/admin', ['as' => 'admin', 'uses' => 'Admin\AdminController@getIndex']);
		Route::resource('/admin/users', 'Admin\UserController@index', ['only' => 'index']);
		Route::resource('/admin/profile-sekolah', 'Admin\ProfileSekolahController', ['only' => 'index']);
		Route::resource('/admin/paket-keahlian', 'Admin\PaketKeahlianController', ['only' => 'index']);
		Route::resource('/admin/guru', 'Admin\GuruController', ['only' => 'index']);
		Route::resource('/admin/siswa', 'Admin\SiswaController', ['only' => 'index']);
		Route::resource('/admin/kelas', 'Admin\KelasController', ['only' => 'index']);
		Route::resource('/admin/siswa-kelas', 'Admin\SiswaPerKelasController', ['only' => 'index']);
		
		# Admin mapel routes...
		Route::resource('/admin/mapel', 'Admin\MapelController', ['only' => ['index', 'edit', 'update']]);
		Route::get('/admin/paket/{paket_id}/mapel', ['as' => 'admin.mapel.paket.index' ,'uses' => 'Admin\MapelController@indexByPaket']);

		# Admin kompetensi routes...
		Route::resource('/admin/kompetensi-dasar', 'Admin\KompetensiController', ['only' => 'index']);
		Route::get('/admin/mapel/{mapel_id}/kompetensi-dasar', ['as' => 'admin.kompetensi-dasar.mapel.index', 'uses' => 'Admin\KompetensiController@indexByMapel']);

		# Admin mapel - SelectBoxFeeder (Ajax request) routes...
		Route::get('/admin/mapel/select-box-feed/bidang', ['as' => 'admin.mapel.select-box-feed.bidang', 'uses' => 'Admin\MapelController@selectBoxFeedBidang']);
		Route::get('/admin/mapel/select-box-feed/program/{bidang_id}', ['as' => 'admin.mapel.select-box-feed.program', 'uses' => 'Admin\MapelController@selectBoxFeedProgram']);
		Route::get('/admin/mapel/select-box-feed/paket/{program_id}', ['as' => 'admin.mapel.select-box-feed.paket',  'uses' => 'Admin\MapelController@selectBoxFeedPaket']);
		Route::get('/admin/kompetensi-dasar/select-box-feed/mapel/{paket_id}', ['as' => 'admin.kompetensi-dasar.select-box-feed.mapel', 'uses' => 'Admin\MapelController@selectBoxFeedMapel']);

		# Admin nilai-pengetahuan routes...
		Route::resource('/admin/nilai-pengetahuan', 'Admin\NilaiPengetahuanController', ['only' => ['index']]);
		Route::get('/admin/nilai-pengetahuan/dropdown/kelas', ['as' => 'admin.nilai-pengetahuan.dropdown.kelas', 'uses' => 'Admin\NilaiPengetahuanController@kelasDropDown']);
		Route::get('/admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester', ['as' => 'admin.nilai-pengetahuan.dropdown.semester', 'uses' => 'Admin\NilaiPengetahuanController@semesterFromKelasDropDown']);
		Route::get('/admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester/{semester}/mapel', ['as' => 'admin.nilai-pengetahuan.dropdown.semester.mapel', 'uses' => 'Admin\NilaiPengetahuanController@mapelFromSemesterFromKelas']);
		Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-pengetahuan', ['as' => 'admin.nilai-pengetahuan.index-byMapel', 'uses' => 'Admin\NilaiPengetahuanController@indexByMapel']);
		Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan/edit', ['as' => 'admin.nilai-pengetahuan.edit', 'uses' => 'Admin\NilaiPengetahuanController@edit']);
		Route::put('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan', ['as' => 'admin.nilai-pengetahuan.update', 'uses' => 'Admin\NilaiPengetahuanController@update']);

		# Admin nilai-keterampilan routes...
		Route::resource('/admin/nilai-keterampilan', 'Admin\NilaiKeterampilanController', ['only' => ['index']]); 
		Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-keterampilan', ['as' => 'admin.nilai-keterampilan.index-byMapel', 'uses' => 'Admin\NilaiKeterampilanController@indexByMapel']);
		Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-keterampilan/edit', ['as' => 'admin.nilai-keterampilan.edit', 'uses' => 'Admin\NilaiKeterampilanController@edit']);
		Route::put('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-keterampilan', ['as' => 'admin.nilai-keterampilan.update', 'uses' => 'Admin\NilaiKeterampilanController@update']);

		# Admin nilai-sikap routes...
		Route::resource('/admin/nilai-sikap', 'Admin\NilaiSikapController', ['only' => ['index']]); 
		Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-sikap', ['as' => 'admin.nilai-sikap.index-byMapel', 'uses' => 'Admin\NilaiSikapController@indexByMapel']);
		Route::get('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-sikap/edit', ['as' => 'admin.nilai-sikap.edit', 'uses' => 'Admin\NilaiSikapController@edit']);
		Route::put('/admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-sikap', ['as' => 'admin.nilai-sikap.update', 'uses' => 'Admin\NilaiSikapController@update']);

		# Admin raport routes...
		Route::get('/admin/raport/search', ['as' => 'admin.raport.index', 'uses' => 'Admin\RaporController@index']);
		Route::get('/admin/raport/kelas/{kelas_id}/semester/{semester}', ['as' => 'admin.raport.indexByKelas', 'uses' => 'Admin\RaporController@indexByKelas']);
		Route::get('/admin/raport/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}', ['as' => 'admin.raport.indexBySiswa', 'uses' => 'Admin\RaporController@indexBySiswa']);
		
		# Admin import / export data routes...
		Route::get('/admin/data/import', ['as' => 'admin.data.import', 'uses' => 'Admin\DataController@index']);
		Route::get('/admin/data/import/draft-guru', ['as' => 'admin.data.export.guru', 'uses' => 'Admin\DataController@exportGuru']);
		Route::post('/admin/data/import/guru', ['as' => 'admin.data.import.guru', 'uses' => 'Admin\DataController@importGuru']);

	});

	Route::get('/guru', ['as' => 'guru', function() { return 'guru'; }]);
	Route::get('/walas', ['as' => 'walas', function() { return 'walas'; }]);

	# Home Routes...
	Route::get('/home', ['as' => 'home', function(Illuminate\Auth\Guard $auth) { 
		switch ($auth->user()->level) {
			case 'admin':
				return redirect()->route('admin');
				break;

			case 'guru':
				return redirect()->route('guru');
				break;

			case 'walas':
				return redirect()->route('walas');
				break;
			
			default:
				return redirect()->route('home');
				break;
		}
	}]);
});

Route::get('/test', function(\App\Services\Excel\GuruListImport $export) {
	return $export->handleImport();
});

Route::get('/template', function() {
	return view('template');
});
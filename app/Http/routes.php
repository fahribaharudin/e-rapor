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
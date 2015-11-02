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
		Route::resource('/admin/mapel', 'Admin\MapelController', ['only' => 'index']);
		Route::get('/admin/mapel/paket/{paket_id}', [
			'as' => 'admin.mapel.paket.index' ,'uses' => 'Admin\MapelController@indexByPaket'
		]);

		# Admin mapel - SelectBoxFeeder (Ajax request) routes...
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
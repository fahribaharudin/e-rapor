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
		require_once app_path('Http/_routes-admin.php');
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

Route::get('/excel-test', function(\App\Services\Excel\GuruListImport $export) {
	return $export->handleImport();
});
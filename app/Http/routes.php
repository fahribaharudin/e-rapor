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

	# Guru Routes...
	Route::group(['middleware' => 'guru'], function() {
		
		require_once app_path('Http/_routes-guru.php');
	
	});

	# Home Routes...
	Route::get('/home', ['as' => 'home', function(Illuminate\Auth\Guard $auth) { 
		if ($auth->user()->hasRole('Administrator')) {
			return redirect()->route('admin');
        } else if ($auth->user()->hasRole('Wali Kelas')) {
			return redirect()->route('guru');
        } else if ($auth->user()->hasRole('Guru')) {	
			return redirect()->route('guru');
        } else {
			return redirect()->route('home');	
        }
	}]);
});

Route::group([], function() {
	require_once app_path('Http/_routes-ajax.php');
});
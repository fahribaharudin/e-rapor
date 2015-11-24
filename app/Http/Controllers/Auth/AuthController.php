<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

	/**
	 * The Laravel Authentication Service
	 * 
	 * @var Illuminate\Auth\Guard
	 */
	protected $auth;


	/**
	 * Class Constructor
	 * 
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->middleware('guest', ['except' => 'getLogout']);
		$this->auth = $auth;
	}


	/**
	 * Handle (GET) Request from: /auth/login
	 * 
	 * @return Response
	 */
	public function getLogin()
	{
		return view('auth.login');
	}


	/**
	 * Handle (POST) Request from: /auth/login
	 * 
	 * @return Response
	 */
	public function postLogin(Request $request)
	{
		if ($this->auth->attempt($request->except('_token'))) {
			if ($this->auth->user()->hasRole('Administrator')) {
				return redirect()->route('admin');
			} elseif ($this->auth->user()->hasRole('Guru')) {
				return redirect()->route('guru');
			} elseif ($this->auth->user()->hasRole('Wali Kelas')) {
				return redirect()->route('walas');
			} else {
				return redirect()->route('home');
			}
		}

		return redirect()->back()->withErrors(['auth' => 'Login gagal, username atau password salah!']);
	}	


	/**
	 * Handle (GET) Request from: /auth/logout
	 * 
	 * @return Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect()->route('auth.login');
	}
}

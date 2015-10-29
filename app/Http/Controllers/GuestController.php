<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{

	/**
	 * Class Constructor!
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}


	/**
	 * Handle (GET) request from: /
	 * 
	 * @return Response
	 */
    public function getLandingPage()
    {
    	return view('landing-page');
    }

}
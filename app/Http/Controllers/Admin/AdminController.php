<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

	/**
	 * Handle (GET) request from: /admin
	 * 
	 * @return Response
	 */
    public function getIndex()
    {
    	return view('admin.index');
    }
    
}

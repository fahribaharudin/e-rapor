<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MapelController extends Controller
{
    
    /**
     * Handle (GET) Request from: /admin/mapel
     * 
     * @return Response 
     */
	public function index()
	{
		return view('admin.mapel.index');
	}

}

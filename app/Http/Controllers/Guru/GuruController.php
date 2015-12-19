<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories;

class GuruController extends Controller
{
    
    /**
     * Handle (GET) Request from: /guru
     * 
     * @return Response 
     */
	public function index()
	{
		return view('guru.index')->with(compact('kelas'));
	}

}

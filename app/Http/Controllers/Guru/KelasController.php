<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    
    /**
     * Handle (GET) Request from: /guru/kelas
     * 
     * @param  Guard  $auth 
     * @return Response       
     */
	public function index(Guard $auth)
	{
		$kelas = $auth->user()->owner->kelas[0];

		return view('guru.kelas.index')->with(compact('kelas'));
	}

}

<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    
    /**
     * Handle (GET) Request from: /admin/kelas/siswa
     * 
     * @param  Guard  $auth 
     * @return Response       
     */
	public function index(Guard $auth)
	{
		$siswaKelas = $auth->user()->owner->kelas[0]->siswa;

		return view('guru.siswa.index')->with(compact('siswaKelas'));
	}

}

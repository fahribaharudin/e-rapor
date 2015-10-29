<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SiswaRepository;

class SiswaController extends Controller
{

	/**
	 * Handle (GET) Request from: /admin/siswa
	 * 
	 * @return Response 
	 */
    public function index(SiswaRepository $siswaRepository)
    {
    	$semuaSiswa = $siswaRepository->getAll();

    	return view('admin.siswa.index')->with(compact('semuaSiswa'));
    }
    
}

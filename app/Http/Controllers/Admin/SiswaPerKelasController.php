<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SiswaRepository;

class SiswaPerKelasController extends Controller
{
    
    /**
     * Handle (GET) Request from: /admin/siswa-kelas
     * 
     * @return Response 
     */
	public function index(SiswaRepository $siswaRepository)
	{
		$semuaSiswa = $siswaRepository->getWithKelas();

		return view('admin.siswa-kelas.index')->with(compact('semuaSiswa'));
	}

}

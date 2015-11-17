<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\KelasRepository;
use App\Repositories\SiswaRepository;
use App\Services\NilaiFormater;

class RaporController extends Controller
{

	/**
	 * Handle (GET) Request from: /admin/raport/search
	 * 
	 * @return Response 
	 */
    public function index()
    {
    	return view('admin.raport.index');
    }


    /**
     * Handle (GET) Request from: /admin/raport/kelas/{kelas_id}/semester/{semester}
     * 
     * @param  integer          $kelas_id  
     * @param  integer          $semester  
     * @param  KelasRepository $kelasRepo 
     * @return Response                    
     */
    public function indexByKelas($kelas_id, $semester, KelasRepository $kelasRepo)
    {
    	$kelas = $kelasRepo->getOne($kelas_id);
    	$kelas->siswa = $kelas->siswa()->get();
    	$kelas->semester = $semester;

    	return view('admin.raport.index-byKelas')->with(compact('kelas'));
    }


    /**
     * Handle (GET) Request from: /admin/raport/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}
     * 
     * @param  integer          $kelas_id  
     * @param  integer          $semester  
     * @param  integer          $siswa_id  
     * @param  KelasRepository $kelasRepo 
     * @param  SiswaRepository $siswaRepo 
     * @return Response                     
     */
    public function indexBySiswa($kelas_id, $semester, $siswa_id, KelasRepository $kelasRepo, SiswaRepository $siswaRepo)
    {
    	$kelas = $kelasRepo->getOne($kelas_id);
    	$kelas->siswa = $kelas->siswa()->get();
    	$kelas->semester = $semester;
    	
    	$siswa = $siswaRepo->getOne($siswa_id);
    	$nilaiFormatter = new NilaiFormater;

    	return view('admin.raport.index-bySiswa')->with(compact('kelas', 'siswa', 'nilaiFormatter'));
    }
}

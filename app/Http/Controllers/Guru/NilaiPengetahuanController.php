<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\KelasRepository;
use App\Jobs\Nilai\ListingNilai;
use App\Jobs\Nilai\ShowNilai;
use App\Jobs\Nilai\UpdateNilai;
use Auth;

class NilaiPengetahuanController extends Controller
{
    
    /**
     * Handle (GET) Request from: /guru/mapel/nilai-pengetahuan
     * 
     * @param  KelasRepository $kelasRepo 
     * @return Response                     
     */
	public function index(KelasRepository $kelasRepo)
	{
		$kelas = $kelasRepo->kelas;
		$semuaMapel = Auth::user()->owner->mapel;

		return view('guru.nilai-pengetahuan.index')->with(compact('kelas', 'semuaMapel'));
	}


	/**
	 * Handle (GET) Request from: 
	 * /guru/mapel/{mapel}/nilai-pengetahuan/kelas/{kelas}/semester/{semester}
	 * 
	 * @param  integer          $mapel     
	 * @param  integer          $kelas     
	 * @param  integer          $semester 
	 * @return Response                     
	 */
	public function indexByKelas($mapel_id, $kelas_id, $semester)
	{        
		$data = $this->dispatch(new ListingNilai($mapel_id, $kelas_id, $semester));

		return view('guru.nilai-pengetahuan.index-byKelas')->with($data);
	}


	/**
	 * Handle (GET) Request from: 
	 * /guru/mapel/{mapel_id}/nilai-pengetahuan/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/edit
	 * 
	 * @param  integer          $mapel_id  
	 * @param  integer          $kelas_id  
	 * @param  integer          $semester  
	 * @param  integer          $siswa_id 
	 * @return Response                     
	 */
	public function edit($mapel_id, $kelas_id, $semester, $siswa_id)
	{
		$data = $this->dispatch(new ShowNilai($mapel_id, $kelas_id, $semester, $siswa_id));

		return view('guru.nilai-pengetahuan.edit')->with($data);
	}
	

	/**
	 * Handle (POST) Request from: 
	 * /guru/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan
	 * 
	 * @param  Request $request 
	 * @return Response           
	 */
	public function update(Request $request)
	{
		$request_data = $request->except([
            '_token', '_method', 'siswa_id', 'mapel_id', 'kelas_id', 'semester'
        ]);

		// Here the magic happens! :)
        $nilaiUpdate = $this->dispatchFrom(UpdateNilai::class, $request, [
            'request_data' => $request_data,
            'type' => 'pengetahuan'
        ]);

        if ($nilaiUpdate != false) {
            return redirect()->route('guru.mapel.nilai-pengetahuan.kelas.index', [
                $request->get('mapel_id'),
                $request->get('kelas_id'),
                $request->get('semester'),
            ]);
        }
	}

}

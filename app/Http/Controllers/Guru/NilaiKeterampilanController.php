<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\Nilai\ListingNilai;
use App\Jobs\Nilai\ShowNilai;
use App\Jobs\Nilai\UpdateNilai;

class NilaiKeterampilanController extends Controller
{
    
	public function index()
	{
		return view('guru.nilai-keterampilan.index');
	}

	/**
     * Handle (GET) Request 
     * from: /guru/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-keterampilan/
     * 
     * @param  integer          $mapel_id  
     * @param  integer          $kelas_id  
     * @param  integer          $semseter
     * @return Response                     
     */
    public function indexByMapel($mapel_id, $kelas_id, $semester)
    {
        $data = $this->dispatch(new ListingNilai($mapel_id, $kelas_id, $semester));

        return view('guru.nilai-keterampilan.index-byMapel')->with($data);
    }


    /**
     * Handle (GET) Request 
     * from: /guru/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-keterampilan/edit
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

        return view('guru.nilai-keterampilan.edit')->with($data);
    }


    /**
     * Handle (PUT) Request 
     * from: /guru/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-keterampilan
     * 
     * @param  Request         $request   
     * @param  NilaiRepository $nilaiRepo 
     * @param  MapelRepository $mapelRepo 
     * @return Response                     
     */
    public function update(Request $request)
    {
        $request_data = $request->except([
            '_token', '_method', 'siswa_id', 'mapel_id', 'kelas_id', 'semester'
        ]);

        $nilaiUpdate = $this->dispatchFrom(UpdateNilai::class, $request, [
            'request_data' => $request_data,
            'type' => 'keterampilan'
        ]);

        if ($nilaiUpdate != false) {
            return redirect()->route('guru.mapel.nilai-keterampilan.index', [
                $request->get('mapel_id'),
                $request->get('kelas_id'),
                $request->get('semester'),
            ]);
        }
    }

}

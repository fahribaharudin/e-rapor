<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ControllerTrait\NilaiDropDownFeed as DropDownFeed;
use App\Jobs\Nilai\ListingNilai;
use App\Jobs\Nilai\ShowNilai;
use App\Jobs\Nilai\UpdateNilai;

class NilaiPengetahuanController extends Controller
{
    
	use DropDownFeed;
    
    /**
     * Handle (GET) Request: from /admin/nilai-pengetahuan
     * 
     * @return Response
     */
    public function index()
    {
    	return view('admin.nilai-pengetahuan.index');
    }


    /**
     * Handle (GET) Request 
     * from: /admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-pengetahuan/
     * 
     * @param  integer          $mapel_id  
     * @param  integer          $kelas_id  
     * @param  integer          $semseter
     * @return Response                     
     */
    public function indexByMapel($mapel_id, $kelas_id, $semester)
    {
        $data = $this->dispatch(new ListingNilai($mapel_id, $kelas_id, $semester));

        return view('admin.nilai-pengetahuan.index-byMapel')->with($data);
    }


    /**
     * Handle (GET) Request 
     * from: /admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan/edit
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

        return view('admin.nilai-pengetahuan.edit')->with($data);
    }


    /**
     * Handle (PUT) Request 
     * from: /admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-pengetahuan
     * 
     * @param  Request         $request
     * @return Response                     
     */
    public function update(Request $request)
    {
        $request_data = $request->except([
            '_token', '_method', 'siswa_id', 'mapel_id', 'kelas_id', 'semester'
        ]);

        $nilaiUpdate = $this->dispatchFrom(UpdateNilai::class, $request, [
            'request_data' => $request_data,
            'type' => 'pengetahuan'
        ]);

        if ($nilaiUpdate != false) {
            return redirect()->route('admin.nilai-pengetahuan.index-byMapel', [
                $request->get('mapel_id'),
                $request->get('kelas_id'),
                $request->get('semester'),
            ]);
        }
    }

}

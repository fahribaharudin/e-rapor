<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MapelRepository;
use App\Repositories\KelasRepository;
use App\Repositories\SiswaRepository;
use App\Repositories\NilaiRepository;

class NilaiSikapController extends Controller
{
    
	public function index()
	{
		return view('admin.nilai-sikap.index');
	}

	/**
     * Handle (GET) Request 
     * from: /admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/nilai-sikap/
     * 
     * @param  integer          $mapel_id  
     * @param  integer          $kelas_id  
     * @param  integer          $semseter
     * @param  MapelRepository $mapelRepo 
     * @param  KelasRepository $kelasRepo 
     * @return Response                     
     */
    public function indexByMapel($mapel_id, $kelas_id, $semester, MapelRepository $mapelRepo, KelasRepository $kelasRepo)
    {
        $mapel = $mapelRepo->getOne($mapel_id);
        $kelas = $kelasRepo->getOne($kelas_id);
        $kelas->siswa_kelas = $kelas->siswa;
        $kelas->semester = $semester;
        $nilaiFormater = new \App\Services\NilaiFormater;

        return view('admin.nilai-sikap.index-byMapel')->with(compact('mapel', 'kelas', 'nilaiFormater'));
    }


    /**
     * Handle (GET) Request 
     * from: /admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-sikap/edit
     * 
     * @param  integer          $mapel_id  
     * @param  integer          $kelas_id  
     * @param  integer          $semester  
     * @param  integer          $siswa_id  
     * @param  MapelRepository $mapelRepo 
     * @param  KelasRepository $kelasRepo 
     * @param  SiswaRepository $siswaRepo 
     * @return Response                     
     */
    public function edit($mapel_id, $kelas_id, $semester, $siswa_id, MapelRepository $mapelRepo, KelasRepository $kelasRepo, SiswaRepository $siswaRepo)
    {
        $mapel = $mapelRepo->getOne($mapel_id);
        $mapel->kompetensi_dasar = $mapel->kompetensiDasar()->where('semester', '=', $semester)->get();
        $siswa = $siswaRepo->getOne($siswa_id);
        $siswa->kelas = $kelasRepo->getOne($kelas_id);
        $siswa->semester = $semester;

        return view('admin.nilai-sikap.edit')->with(compact('mapel', 'siswa'));
    }


    /**
     * Handle (PUT) Request 
     * from: /admin/mapel/{mapel_id}/kelas/{kelas_id}/semester/{semester}/siswa/{siswa_id}/nilai-sikap
     * 
     * @param  Request         $request   
     * @param  NilaiRepository $nilaiRepo 
     * @param  MapelRepository $mapelRepo 
     * @return Response                     
     */
    public function update(Request $request, NilaiRepository $nilaiRepo, MapelRepository $mapelRepo)
    {
        $mapel = $mapelRepo->getOne($request->get('mapel_id'));
        $nilai = [
            'sikap' => [
                'siswa_id' => $request->get('siswa_id'), 
                'mapel_id' => $mapel->id,
                'semester' => $request->get('semester'),
            ]
        ];

        $i = 1;
        
        // Formating nilai from request to array
        foreach ($mapel->kompetensiDasar()->where('semester', '=', $request->get('semester'))->get() as $kompetensi_dasar) {
            if ($request->has('nilai_observasi_kd_' . $i)) {
                $nilai['sikap']['observasi']['kd_' . $i] = $request->get('nilai_observasi_kd_' . $i);
            }
            if ($request->has('nilai_penilaian_diri_kd_' . $i)) {
                $nilai['sikap']['penilaian_diri']['kd_' . $i] = $request->get('nilai_penilaian_diri_kd_' . $i);
            }
            if ($request->has('nilai_penilaian_sebaya_kd_' . $i)) {
                $nilai['sikap']['penilaian_sebaya']['kd_' . $i] = $request->get('nilai_penilaian_sebaya_kd_' . $i);
            }
            if ($request->has('nilai_jurnal_kd_' . $i)) {
                $nilai['sikap']['jurnal']['kd_' . $i] = $request->get('nilai_jurnal_kd_' . $i);
            }
            $i++;
        }

        // Updating nilai on Repo
        if ($nilaiRepo->update($nilai) != false) {
            return redirect()->route('admin.nilai-sikap.index-byMapel', [
                $request->get('mapel_id'),
                $request->get('kelas_id'),
                $request->get('semester'),
            ]);
        }
    }

}

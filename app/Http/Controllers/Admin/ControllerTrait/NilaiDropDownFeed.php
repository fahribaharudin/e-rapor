<?php 

namespace App\Http\Controllers\Admin\ControllerTrait;

trait NilaiDropDownFeed
{

	/**
	 * Handle (GET) Ajax Request from: /admin/nilai-pengetahuan/dropdown/kelas
	 * 
	 * @param  \App\Services\SelectBoxGenerator $generator 
	 * @return Response                                      
	 */
	public function kelasDropDown(\App\Services\SelectBoxGenerator $generator)
	{
		return $generator->generateKelasContainsSiswa();
	}


	/**
	 * Handle (GET) Ajax Request 
	 * from: /admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester
	 * 
	 * @param  integer                            $kelas_id  
	 * @param  \App\Repositories\KelasRepository $kelasRepo 
	 * @return Reponse                                       
	 */
	public function semesterFromKelasDropDown($kelas_id, \App\Repositories\KelasRepository $kelasRepo)
	{
		$kelas = $kelasRepo->getOne($kelas_id);

		$selectBox = [];

		switch ($kelas->tingkat_kelas) {
			case 1:
				$selectBox[] = ['value' => 1, 'text' => 1];
				$selectBox[] = ['value' => 2, 'text' => 2];
				break;
			
			case 2:
				$selectBox[] = ['value' => 3, 'text' => 3];
				$selectBox[] = ['value' => 4, 'text' => 4];
				break;
			
			case 3:
				$selectBox[] = ['value' => 5, 'text' => 5];
				$selectBox[] = ['value' => 6, 'text' => 6];
				break;
		}

		return $selectBox;
	}


	/**
	 * Handle (GET) Ajax Request 
	 * from: /admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester/{semester}/mapel
	 * 
	 * @param  integer                            $kelas_id  
	 * @param  integer                            $semester  
	 * @param  \App\Repositories\KelasRepository $kelasRepo 
	 * @return Response                                       
	 */
	public function mapelFromSemesterFromKelas($kelas_id, $semester, \App\Repositories\KelasRepository $kelasRepo)
	{
		$kelas = $kelasRepo->getOne($kelas_id);

		$selectBox = [];
		foreach ($kelas->paketKeahlian->mapel as $mapel) {
			if (in_array($semester, explode(',', $mapel->semester))) {
  				// if (count($mapel->guru) != 0) {
					$selectBox[] = ['value' => $mapel->id, 'text' => $mapel->child->nama_mapel];
  				// }
			}
		}

		return $selectBox;
	}

}
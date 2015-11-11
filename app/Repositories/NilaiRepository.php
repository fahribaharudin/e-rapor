<?php 

namespace App\Repositories;

use App\Eloquent;
use App\Repositories\MapelRepository;

class NilaiRepository extends Repository
{

	protected $mapelRepo;

	protected $nilai_pengetahuan;

	protected $nilai_keterampilan;

	protected $nilai_sikap;

	public function __construct(MapelRepository $mapelRepo, Eloquent\NilaiPengetahuan $nilai_p)
	{
		$this->mapelRepo = $mapelRepo;
		$this->nilai_pengetahuan = $nilai_p;
	}

	public function getAll() 
	{
		// 
	}


	/**
	 * Update nilai on the database
	 * @param  array  $nilai 
	 * @return array        
	 */
	public function update(array $nilai)
	{
		if (array_key_exists('pengetahuan', $nilai)) {
			return $this->updateNilaiPengetahuan($nilai['pengetahuan']);
		}

		return false;
	}


	/**
	 * Update nilai pengetahuan from a siswa and mapel
	 * 
	 * @param  array $nilai array of data that coming from request / Controller
	 * @return array 
	 */
	protected function updateNilaiPengetahuan($nilai) 
	{
		$mapel = $this->mapelRepo->getOne($nilai['mapel_id']);
		$nilai_pengetahuan = [];

		$i = 1;
		foreach ($mapel->kompetensiDasar()->where('semester', '=', $nilai['semester'])->get() as $kompetensi) {
			$nilai_db = $this->nilai_pengetahuan
				->where('mapel_id', '=', $mapel->id)
				->where('siswa_id', '=', $nilai['siswa_id'])
				->where('kompetensi_id', '=', $kompetensi->id)
				->first();

			// if nilai pengetahuan already exists in database than we update it
			if ($nilai_db != null) {
				$nilai_db->tertulis = $nilai['tertulis']['kd_' . $i];
				$nilai_db->observasi = $nilai['observasi']['kd_' . $i];
				$nilai_db->penugasan = $nilai['penugasan']['kd_' . $i];
				$nilai_db->save();
				$nilai_pengetahuan[] = $nilai_db;
			} 
			// else we create a new one! :)
			else {
				$nilai_pengetahuan[] = $this->nilai_pengetahuan->create([
					'siswa_id' => $nilai['siswa_id'], 
					'mapel_id' => $mapel->id, 
					'kompetensi_id' => $kompetensi->id, 
					'semester' => $nilai['semester'],
			    	'tertulis' => $nilai['tertulis']['kd_' . $i], 
			    	'observasi' => $nilai['observasi']['kd_' . $i], 
			    	'penugasan' => $nilai['penugasan']['kd_' . $i]
				]);
			}
			$i++;
		}

		return $nilai_pengetahuan;
	}

}
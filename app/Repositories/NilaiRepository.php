<?php 

namespace App\Repositories;

use App\Eloquent;
use App\Repositories\MapelRepository;

class NilaiRepository extends Repository
{

	/**
	 * Mapel Repository
	 * 
	 * @var App\Repositories\MapelRepository
	 */
	protected $mapelRepo;

	/**
	 * NilaiPengetahuan Eloquent Model
	 * 
	 * @var App\Eloquent\NilaiPengetahuan
	 */
	protected $nilai_pengetahuan;

	/**
	 * NilaiKeterampilan Eloquent Model
	 * 
	 * @var App\Eloquent\NilaiKeterampilan
	 */
	protected $nilai_keterampilan;

	/**
	 * NilaiSikap Eloquent Model
	 * 
	 * @var App\Eloquent\NilaiSikap
	 */
	protected $nilai_sikap;


	/**
	 * Class Constructor!
	 * 
	 * @param MapelRepository            $mapelRepo 
	 * @param Eloquent\NilaiPengetahuan  $nilai_p   
	 * @param Eloquent\NilaiKeterampilan $nilai_k   
	 * @param Eloquent\NilaiSikap        $nilai_s   
	 */
	public function __construct(MapelRepository $mapelRepo, Eloquent\NilaiPengetahuan $nilai_p, Eloquent\NilaiKeterampilan $nilai_k, Eloquent\NilaiSikap $nilai_s)
	{
		$this->mapelRepo = $mapelRepo;
		$this->nilai_pengetahuan = $nilai_p;
		$this->nilai_keterampilan = $nilai_k;
		$this->nilai_sikap = $nilai_s;
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
		} elseif (array_key_exists('keterampilan', $nilai)) {
			return $this->updateNilaiKeterampilan($nilai['keterampilan']);
		} elseif (array_key_exists('sikap', $nilai)) {
			return $this->updateNilaiSikap($nilai['sikap']);
		}

		return false;
	}


	/**
	 * Update nilai pengetahuan from a siswa and mapel
	 * 
	 * @param  array $nilai array of data that coming from request / Controller
	 * @return array 
	 */
	protected function updateNilaiPengetahuan(array $nilai) 
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


	/**
	 * Update nilai keterampilan from a siswa and mapel
	 * 
	 * @param  array $nilai array of data that coming from request / Controller
	 * @return array 
	 */
	protected function updateNilaiKeterampilan(array $nilai) 
	{
		$mapel = $this->mapelRepo->getOne($nilai['mapel_id']);
		$nilai_keterampilan = [];

		$i = 1;
		foreach ($mapel->kompetensiDasar()->where('semester', '=', $nilai['semester'])->get() as $kompetensi) {
			$nilai_db = $this->nilai_keterampilan
				->where('mapel_id', '=', $mapel->id)
				->where('siswa_id', '=', $nilai['siswa_id'])
				->where('kompetensi_id', '=', $kompetensi->id)
				->first();

			// if nilai pengetahuan already exists in database than we update it
			if ($nilai_db != null) {
				$nilai_db->praktek = $nilai['praktek']['kd_' . $i];
				$nilai_db->project = $nilai['project']['kd_' . $i];
				$nilai_db->produk = $nilai['produk']['kd_' . $i];
				$nilai_db->portofolio = $nilai['portofolio']['kd_' . $i];
				$nilai_db->tertulis = $nilai['tertulis']['kd_' . $i];
				$nilai_db->save();
				$nilai_keterampilan[] = $nilai_db;
			} 
			// else we create a new one! :)
			else {
				$nilai_keterampilan[] = $this->nilai_keterampilan->create([
					'siswa_id' => $nilai['siswa_id'], 
					'mapel_id' => $mapel->id, 
					'kompetensi_id' => $kompetensi->id, 
					'semester' => $nilai['semester'],
			    	'praktek' => $nilai['praktek']['kd_' . $i],
			    	'project' => $nilai['project']['kd_' . $i],
			    	'produk' => $nilai['produk']['kd_' . $i],
			    	'portofolio' => $nilai['portofolio']['kd_' . $i],
			    	'tertulis' => $nilai['tertulis']['kd_' . $i],
				]);
			}
			$i++;
		}

		return $nilai_keterampilan;
	}


	/**
	 * Update nilai sikap from a siswa and mapel
	 * 
	 * @param  array $nilai array of data that coming from request / Controller
	 * @return array 
	 */
	public function updateNilaiSikap(array $nilai) 
	{
		$mapel = $this->mapelRepo->getOne($nilai['mapel_id']);
		$nilai_sikap = [];

		$i = 1;
		foreach ($mapel->kompetensiDasar()->where('semester', '=', $nilai['semester'])->get() as $kompetensi) {
			$nilai_db = $this->nilai_sikap
				->where('mapel_id', '=', $mapel->id)
				->where('siswa_id', '=', $nilai['siswa_id'])
				->where('kompetensi_id', '=', $kompetensi->id)
				->first();

			// if nilai pengetahuan already exists in database than we update it
			if ($nilai_db != null) {
				$nilai_db->observasi = $nilai['observasi']['kd_' . $i];
				$nilai_db->penilaian_diri = $nilai['penilaian_diri']['kd_' . $i];
				$nilai_db->penilaian_sebaya = $nilai['penilaian_sebaya']['kd_' . $i];
				$nilai_db->jurnal = $nilai['jurnal']['kd_' . $i];
				$nilai_db->save();
				$nilai_sikap[] = $nilai_db;
			} 
			// else we create a new one! :)
			else {
				$nilai_sikap[] = $this->nilai_sikap->create([
					'siswa_id' => $nilai['siswa_id'], 
					'mapel_id' => $mapel->id, 
					'kompetensi_id' => $kompetensi->id, 
					'semester' => $nilai['semester'],
			    	'observasi' => $nilai['observasi']['kd_' . $i],
			    	'penilaian_diri' => $nilai['penilaian_diri']['kd_' . $i],
			    	'penilaian_sebaya' => $nilai['penilaian_sebaya']['kd_' . $i],
			    	'jurnal' => $nilai['jurnal']['kd_' . $i],
				]);
			}
			$i++;
		}

		return $nilai_sikap;
	}

}
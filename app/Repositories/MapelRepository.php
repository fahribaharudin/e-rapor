<?php 

namespace App\Repositories;

use App\Eloquent;

class MapelRepository extends Repository
{

	/**
	 * Mapel Eloquent Model
	 * 
	 * @var App\Eloquent\Mapel
	 */
	protected $mapel;

	/**
	 * PaketKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\PaketKeahlian
	 */
	protected $paket_keahlian;


	/**
	 * Class Constructor!
	 * 
	 * @param Eloquent\Mapel $mapel
	 * @param Eloquent\PaketKeahlian $paket 
	 */
	public function __construct(Eloquent\Mapel $mapel, Eloquent\PaketKeahlian $paket)
	{
		$this->mapel = $mapel;
		$this->paket_keahlian = $paket;
	}


	/**
	 * Get all mapel from database
	 * 
	 * @return mixed 
	 */
	public function getAll()
	{
		return $this->mapel->with('child')->get();
	}


	/**
	 * Get mapel by Paket Keahlian
	 * 
	 * @param  integer $paket_id 
	 * @return mixed           
	 */
	public function getByPaketKeahlian($paket_id)
	{
		return $this->mapel->with('child')->where('paket_id', '=', $paket_id)->get();
	}


	/**
	 * Get kompetensi dasar by mapel
	 * 
	 * @param  integer $id 
	 * @return mixed     
	 */
	public function getKompetensiDasar($id)
	{
		return $this->mapel->with('kompetensiDasar', 'child', 'paketKeahlian')->where('id', '=', $id)->first();
	}


	/**
	 * Get a mapel from database
	 * 
	 * @param  integer $id 
	 * @return mixed     
	 */
	public function getOne($id)
	{
		return $this->mapel->find($id);
	}


	/**
	 * Update a mapel on the database
	 * also the guru mapel
	 * 
	 * @param  integer $id 
	 * @return mixed     
	 */
	public function update($id, $data)
	{
		$mapel = $this->mapel->find($id);
		
		$data['semester'] = '';
		
		for ($i=1; $i<=6; $i++) {
			if(isset($data['input_semester_' . $i])) {
				// not using sync! this is manual search on pivot :)
				$pivot = \DB::table('guru_mapel')
					->where('mapel_id', '=', $mapel->id)
					->where('semester', '=', $data['input_semester_' . $i]);

				// delete pivot if exists
				$pivot->delete();

				// insert a new pivot / update
				$mapel->guru()->attach($data['input_guru_semester_' . $i], [
					'semester' => $data['input_semester_' . $i]
				]);

				// generate semester string
				$data['semester'] = $data['semester'] . ',' .  $data['input_semester_' . $i];
			}
		}

		// Update the model
		$mapel->kelompok = $data['kelompok'];
		$mapel->semester = ltrim($data['semester'], ',');
		$mapel->child()->update(['nama_mapel' => $data['nama']]);
		
		return $mapel->save();
	}

}
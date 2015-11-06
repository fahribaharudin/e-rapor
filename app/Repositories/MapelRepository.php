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

}
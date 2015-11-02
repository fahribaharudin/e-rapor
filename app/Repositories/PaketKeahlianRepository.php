<?php 

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Eloquent\PaketKeahlian;
use App\Eloquent\BidangKeahlian;

class PaketKeahlianRepository extends Repository
{

	/**
	 * BidangKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\BidangKeahlian
	 */
	protected $bidangKeahlian;

	/**
	 * PaketKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\PaketKeahlian
	 */
	protected $paketKeahlian;


	/**
	 * Class Constructor!
	 * 
	 * @param PaketKeahlian $paket 
	 */
	public function __construct(PaketKeahlian $paket, BidangKeahlian $bidang)
	{
		$this->paketKeahlian = $paket;
		$this->bidangKeahlian = $bidang;
	}


	/**
	 * Get All PaketKeahlian from the database
	 * 
	 * @return mixed
	 */
	public function getAll()
	{
		$paketKeahlian = $this->paketKeahlian->with('programKeahlian')->get();
		
		// Inserting bidang keahlian to the collection
		$newPaket = [];
		foreach ($paketKeahlian as $paket) {
			$paket->bidang_keahlian = $this->bidangKeahlian->find($paket->programKeahlian->bidang_id);

			$newPaket[] = $paket;
		}

		return new Collection($newPaket);
	}


	/**
	 * Get a paketKeahlian from the databaese
	 * 
	 * @param  integer $id 
	 * @return mixed     
	 */
	public function getOne($id)
	{
		$paketKeahlian = $this->paketKeahlian->find($id);

		return $paketKeahlian;
	}
}
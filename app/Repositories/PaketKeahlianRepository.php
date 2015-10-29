<?php 

namespace App\Repositories;

use App\Eloquent\PaketKeahlian;

class PaketKeahlianRepository extends Repository
{

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
	public function __construct(PaketKeahlian $paket)
	{
		$this->paketKeahlian = $paket;
	}


	/**
	 * Get All PaketKeahlian from the database
	 * 
	 * @return mixed
	 */
	public function getAll()
	{
		return $this->paketKeahlian->with('programKeahlian', 'bidangKeahlian')->get();
	}
}
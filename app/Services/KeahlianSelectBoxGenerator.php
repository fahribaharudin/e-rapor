<?php 

namespace App\Services;

use App\Eloquent;

class KeahlianSelectBoxGenerator 
{

	/**
	 * BidangKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\BidangKeahlian
	 */
	protected $bidang_keahlian;

	/**
	 * ProgramKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\ProgramKeahlian
	 */
	protected $program_keahlian;
	
	/**
	 * PaketKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\PaketKeahlian
	 */
	protected $paket_keahlian;


	/**
	 * Class Constructor!
	 * 
	 * @param Eloquent\BidangKeahlian  $bidang  
	 * @param Eloquent\ProgramKeahlian $program 
	 * @param Eloquent\PaketKeahlian   $paket   
	 */
	public function __construct(
		Eloquent\BidangKeahlian $bidang, 
		Eloquent\ProgramKeahlian $program, 
		Eloquent\PaketKeahlian $paket) 
	{
		$this->bidang_keahlian = $bidang;
		$this->program_keahlian = $program;
		$this->paket_keahlian = $paket;
	}


	/**
	 * Generate selectBox feed for bidang keahlian
	 * 
	 * @return array 
	 */
	public function generateBidangKeahlian()
	{
		$selectBox = [];
		
		foreach ($this->bidang_keahlian->all() as $bidang) {
			$selectBox[] = [
				'value' => $bidang->id,
				'name' => $bidang->nama,
			];
		}

		return $selectBox;
	}
	

	/**
	 * Generate ProgramKeahlian selectBox feed
	 * 
	 * @param  integer $bidang_id 
	 * @return array            
	 */
	public function generateProgramKeahlian($bidang_id)
	{
		$selectBox = [];
		$program_keahlian = $this->bidang_keahlian->find($bidang_id)->programKeahlian;

		foreach ($program_keahlian as $program) {
			$selectBox[] = ['value' => $program->id, 'name' => $program->nama];
		}

		return $selectBox;
	}
	

	/**
	 * Generate paket keahlian selectbox feed
	 * 
	 * @param  integer $program_id 
	 * @return array             
	 */
	public function generatePaketKeahlian($program_id)
	{
		$selectBox = [];
		$paket_keahlian = $this->program_keahlian->find($program_id)->paketKeahlian;

		foreach ($paket_keahlian as $paket) {
			$selectBox[] = ['value' => $paket->id, 'name' => $paket->nama];
		}

		return $selectBox;

		return $paket_keahlian;
	}
	
}
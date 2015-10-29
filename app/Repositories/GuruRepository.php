<?php 

namespace App\Repositories;

use App\Eloquent\Guru;

class GuruRepository extends Repository
{

	/**
	 * Guru Eloquent Model
	 * 
	 * @var App\Eloquent\Guru
	 */
	protected $guru;


	/**
	 * Class Constructor!
	 * 
	 * @param Guru $guru
	 */
	public function __construct(Guru $guru)
	{
		$this->guru = $guru;
	}


	/**
	 * Get all guru
	 * 
	 * @return mixed
	 */
	public function getAll()
	{
		return $this->guru->all();
	}
}
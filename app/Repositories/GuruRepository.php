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
	public $guru;


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


	/**
	 * Get one guru from database
	 * @param  integer $id 
	 * @return mixed     
	 */
	public function getOne($id)
	{
		return $this->guru->find($id);
	}

}
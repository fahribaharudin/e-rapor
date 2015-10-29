<?php 

namespace App\Repositories;

use App\Eloquent\Kelas;

class KelasRepository extends Repository
{

	/**
	 * Kelas Eloquent Model
	 * 
	 * @var App\Eloquent\Kelas
	 */
	protected $kelas;


	/**
	 * Class Constructor!
	 * 
	 * @param Kelas $kelas 
	 */
	public function __construct(Kelas $kelas)
	{
		$this->kelas = $kelas;
	}


	/**
	 * Get all kelas from database
	 * 
	 * @return mixed 
	 */
	public function getAll()
	{
		return $this->kelas->with('waliKelas', 'paketKeahlian')->get();
	}


	/**
	 * Get all kelas with siswa its contain
	 * 
	 * @return mixed 
	 */
	public function getWithSiswa()
	{
		return $this->kelas->with('siswa')->get();
	}
}
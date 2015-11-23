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
	public $kelas;


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
	 * Get all kelas wich contains siswa on it
	 * 
	 * @return mixed
	 */
	public function getKelasContainsSiswa()
	{
		$allKelas = $this->getAll();
		$allKelas = $allKelas->filter(function($kelas) {
			if (count($kelas->siswa) != 0) {
				return $kelas;
			}
		});

		return $allKelas;
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


	/**
	 * Get one kelas from database
	 * 
	 * @param  integer $kelas_id 
	 * @return mixed           
	 */
	public function getOne($kelas_id)
	{
		return $this->kelas->find($kelas_id);
	}
}
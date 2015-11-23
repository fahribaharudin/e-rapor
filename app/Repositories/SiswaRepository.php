<?php

namespace App\Repositories;

use App\Eloquent\Siswa;

class SiswaRepository extends Repository
{

	/**
	 * Siswa Eloquent Model
	 * 
	 * @var App\Eloquent\Siswa
	 */
	public $siswa;


	/**
	 * Class Constructor!
	 * 
	 * @param Siswa $siswa 
	 */
	public function __construct(Siswa $siswa)
	{
		$this->siswa = $siswa;
	}


	/**
	 * Get all siswa from database
	 * 
	 * @return mixed 
	 */
	public function getAll()
	{
		return $this->siswa->with('paketKeahlian')->get();
	}


	/**
	 * Get all siswa by kelas its attached
	 * 
	 * @return mixed
	 */
	public function getWithKelas()
	{
		$siswaCollection = $this->siswa->with('kelas')->get();

		// filter the collection only for siswa that have kelas
		$siswa = $siswaCollection->filter(function($item) {
			if (count($item->kelas) != 0) {
				return $item;
			}
		})->values();

		return $siswa;
	}


	/**
	 * Get one siswa from database
	 * 
	 * @param  integer $siswa_id 
	 * @return mixed           
	 */
	public function getOne($siswa_id)
	{
		return $this->siswa->find($siswa_id);
	}
}
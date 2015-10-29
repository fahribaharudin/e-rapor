<?php 

namespace App\Repositories;

abstract class Repository
{
	/**
	 * Get all data from model
	 * 
	 * @return mixed
	 */
	abstract public function getAll();
}
<?php 

namespace App\Repositories;

use App\Eloquent\User;

class UserRepository extends Repository
{	
	/**
	 * User Model
	 * 
	 * @var App\Eloquent\User
	 */
	public $user;

	/**
	 * Application Contructor
	 * 
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Get all users
	 * 
	 * @return mixed
	 */
	public function getAll()
	{
		return $this->user->with('owner')->get();
	}

}
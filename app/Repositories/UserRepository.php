<?php 

namespace App\Repositories;

use App\Eloquent;

class UserRepository extends Repository
{	
	
	/**
	 * User Model
	 * 
	 * @var App\Eloquent\User
	 */
	public $user;

	/**
	 * Admin Eloquent Model
	 * 
	 * @var App\Eloquent\Administrator
	 */
	protected $admin;

	/**
	 * Guru Eloquent Model
	 * 
	 * @var App\Eloquent\Guru
	 */
	protected $guru;


	/**
	 * Application Contructor
	 * 
	 * @param User $user
	 */
	public function __construct(Eloquent\User $user, Eloquent\Administrator $admin, Eloquent\Guru $guru)
	{
		$this->user = $user;
		$this->admin = $admin;
		$this->guru = $guru;
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


	/**
	 * Create a new user on the database
	 * 
	 * @param  array  $data 
	 * @return Collection       
	 */
	public function create(array $data)
	{
		if ($data['child']['type'] == 'admin') {
			$child = $this->admin->create(['nama' => $data['child']['nama'], 'nip' => '1200000']);
			$roles = [1];
		} elseif ($data['child']['type'] == 'guru') {
			$child = $this->guru->find($data['child']['nama']);
			$roles = [3];
		} elseif ($data['child']['type'] == 'walas') {
			$child = $this->guru->find($data['child']['nama']);
			$roles = [2, 3];
		}

		$user = $this->user->create([
			'owner_id' => $child->id,
			'owner_type' => get_class($child),
			'username' => $data['username'], 
			'password' => $data['password'], 
		]);

		$user->roles()->attach($roles);

		return $user;
	}

}
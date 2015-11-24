<?php

use Illuminate\Database\Seeder;
use App\Eloquent\User, App\Eloquent\Administrator, App\Eloquent\Guru, App\Eloquent\Role;

class UserTableSeeder extends Seeder
{

	/**
	 * Eloquent User Model
	 * 
	 * @var App\Eloquent\User
	 */
	protected $user;

	/**
	 * Eloquent Administrator Model
	 * 
	 * @var App\Eloquent\Administrator
	 */
	protected $admin;

	/**
	 * Eloquent Guru Model
	 * 
	 * @var App\Eloquent\Guru
	 */
	protected $guru;

    protected $role;


	/**
	 * Class Constructor
	 * 
	 * @param User $user
	 */
	public function __construct(User $user, Administrator $admin, Guru $guru, Role $role)
	{
		$this->user = $user;
		$this->user->truncate();

		$this->admin = $admin;
		$this->admin->truncate();
		
		$this->guru = $guru;
		$this->guru->truncate();

        $this->role = $role;
        $this->role->truncate();

        DB::table('user_roles')->truncate();
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	['username' => 'admin', 'password' => 'password'],
        	// ['username' => 'guru1', 'password' => 'password', 'level' => 'guru'],
        	// ['username' => 'walas1', 'password' => 'password', 'level' => 'walas'],
        ];

        $roles = [
            ['hak_akses' => 'Administrator'],
            ['hak_akses' => 'Wali Kelas'],
            ['hak_akses' => 'Guru'],
        ];

        // $penduduk = array_merge($this->createAdmin(), $this->createGuru());
        $penduduk = array_merge($this->createAdmin());

        foreach ($roles as $role) {
            $this->role->create($role);
        }

        $i = 0;
        foreach ($users as $user) {
        	$u = new User($user);
        	$u->owner_id = $penduduk[$i]->id;
    		$u->owner_type = Administrator::class;
            $u->save();
            $u->roles()->attach(1);

        	$i++;
        }
    }

    
    /**
     * Create some Administrator in the database
     * 
     * @return Array
     */
    protected function createAdmin()
    {
    	$admin = [
    		['nama' => 'Fahri Baharudin', 'nip' => '0610300755201120083']
    	];

    	$admin_array = [];

    	foreach ($admin as $administrator) {
    		$admin_array[] = $this->admin->create($administrator);
    	}

    	return $admin_array;
    }


    /**
     * Create some Guru in the database
     * 
     * @return Array
     */
    public function createGuru()
    {
    	$guru = [
    		['nama' => 'Louis Van Gaal', 'nip' => '610300750'],
    		['nama' => 'Arsene Wenger', 'nip' => '610300751'],
    	];

    	$guru_array = [];

    	foreach ($guru as $g) {
    		$guru_array[] = $this->guru->create($g);
    	}

    	return $guru_array;
    }
}

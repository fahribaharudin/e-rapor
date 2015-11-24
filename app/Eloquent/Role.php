<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The database table used by the model.
     * 
     * @var string
     */
	protected $table = 'roles';

    /**
     * The attribute that mess assignable
     * 
     * @var array
     */
    protected $fillable = ['hak_akses'];

    /**
     * Disable timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

    
    /**
     * Every Role belongs to many User
     * 
     * @return mixed
     */
    public function users() {
    	return $this->belongsToMany(User::class, 'user_roles');
    }

}

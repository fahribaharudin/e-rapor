<?php

namespace App\Eloquent;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['owner_id', 'owner_type', 'username', 'password', 'level'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * Setter for password, the password will automatically hashed
     * 
     * @param string $password 
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }


    /**
     * Polymorphic relation morphTo: [Administrator, Guru]
     * 
     * @return mixed 
     */
    public function owner()
    {
        return $this->morphTo();
    }

    
    /**
     * Every User belongs to many Role
     *
     *  @return mixed 
     */
    public function roles() {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    
    /**
     * Check if a User has a specific roles
     * 
     * @param  string  $name 
     * @return boolean       
     */
    public function hasRole($name) {
        foreach ($this->roles as $role) {
            if ($role->hak_akses == $name) {
                return true;
            }
        }

        return false;
    }
}

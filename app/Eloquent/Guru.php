<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'guru';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'nip'];

    /**
     * Disable timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Polymorphic relation morphOne: User
     * 
     * @return mixed 
     */
    public function userAccount() {
        return $this->morphOne(User::class, 'owner', 'owner_type', 'owner_id', 'id');
    }
}

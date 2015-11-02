<?php 

namespace App\Eloquent\ModelTrait;

use App\Eloquent\User;

trait HasUserAccount
{

    /**
     * MorphOne relation to: App\Eloquent\User
     * 
     * @return mixed 
     */
    public function userAccount() {
        return $this->morphOne(User::class, 'owner', 'owner_type', 'owner_id', 'id');
    }

}
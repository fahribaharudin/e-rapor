<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
	
    /**
     * The database table used by the model.
     *
     * @var string
     */    
    protected $table = 'bidang_keahlian';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama'];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * HasMany Relation to: ProgramKeahlian
     * 
     * @return mixed
     */
    public function programKeahlian()
    {
        return $this->hasMany(ProgramKeahlian::class, 'bidang_id', 'id');
    }

    
    /**
     * HasMany Relation to: PaketKeahlian
     * 
     * @return mixed
     */
    public function paketKeahlian()
    {
        return $this->hasMany(PaketKeahlian::class, 'bidang_id', 'id');
    }
    
}

<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ProgramKeahlian extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */   
    protected $table = 'program_keahlian';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['bidang_id', 'nama'];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * BelongsTo Relation to: BidangKeahlian
     * 
     * @return mixed
     */
    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'bidang_id', 'id');
    }


    /**
     * HasMany Relation to: App\Eloquent\PaketKeahlian
     * 
     * @return mixed 
     */
    public function paketKeahlian()
    {
        return $this->hasMany(PaketKeahlian::class, 'program_id', 'id');
    }
}

<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class PaketKeahlian extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paket_keahlian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['program_id', 'bidang_id', 'nama'];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * BelonsTo Relation to: ProgramKeahlian
     * 
     * @return mixed 
     */
    public function programKeahlian()
    {
        return $this->belongsTo(ProgramKeahlian::class, 'program_id', 'id');
    }


    /**
     * BelonsTo Relation to: App\Eloquent\BidangKeahlian
     * 
     * @return mixed 
     */
    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'bidang_id', 'id');
    }


    /**
     * HasMany Relation tor: App\Eloquent\Siswa
     * 
     * @return mixed 
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'paket_id', 'id');
    }
}

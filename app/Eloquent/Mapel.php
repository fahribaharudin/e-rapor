<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mapel';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'mapel_type', 'mapel_id', 'paket_id', 'kelompok', 'semester'
    ];

    /**
     * Disable timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * Polymorphic relation morphTo: 
     * [MapelWajib, MapelBidang, MapelProgram, MapelPaket]
     * 
     * @return mixed 
     */
    public function child()
    {
        return $this->morphTo();
    }


    /**
     * BelonsTo Relation to: App\Eloquent\PaketKeahlian
     * 
     * @return mixed 
     */
    public function paketKeahlian()
    {
        return $this->belongsTo(PaketKeahlian::class, 'paket_id', 'id');
    }

}

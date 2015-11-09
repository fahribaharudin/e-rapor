<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class NilaiKeterampilan extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nilai_keterampilan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'siswa_id', 'mapel_id', 'kompetensi_id', 'semester',
    	'praktek', 'project', 'produk', 'portofolio', 'tertulis'
    ];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;
}

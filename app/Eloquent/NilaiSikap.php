<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class NilaiSikap extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nilai_sikap';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'siswa_id', 'mapel_id', 'kompetensi_id', 'semester',
    	'observasi', 'penilaian_diri', 'penilaian_sebaya', 'jurnal'
    ];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;
}

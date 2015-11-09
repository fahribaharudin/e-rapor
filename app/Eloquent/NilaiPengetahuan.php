<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class NilaiPengetahuan extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'nilai_pengetahuan';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'siswa_id', 'mapel_id', 'kompetensi_id', 'semester',
    	'tertulis', 'observasi', 'penugasan'
    ];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;
}

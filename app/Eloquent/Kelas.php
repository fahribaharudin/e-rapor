<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */   
    protected $table = 'kelas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['paket_id', 'guru_id', 'nama_kelas', 'tingkat_kelas'];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * BelongsTo Relation to: App\Eloquent\Guru
     * 
     * @return mixed 
     */
    public function waliKelas()
    {
    	return $this->belongsTo(Guru::class, 'guru_id', 'id');
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


    /**
     * HasMany Relation to: App\Eloquent\Siswa
     * 
     * @return mixed 
     */
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_perkelas', 'kelas_id');
    }

}

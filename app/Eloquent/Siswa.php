<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{

	/**
     * The database table used by the model.
     *
     * @var string
     */ 
    protected $table = 'siswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'paket_id', 'nis', 'nisn', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
    	'agama', 'status_dalam_kel', 'anak_ke', 'alamat_siswa', 'sekolah_asal', 'diterima_kelas',
    	'diterima_tanggal', 'nama_ayah', 'nama_ibu', 'alamat_ortu', 'nama_wali', 'pekerjaan_wali',
    	'alamat_wali', 'telepon_wali', 'foto'
    ];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * BelongsTo Relation to: App\Eloquent\PaketKeahlian
     * 
     * @return mixed 
     */
    public function paketKeahlian()
    {
        return $this->belongsTo(PaketKeahlian::class, 'paket_id', 'id');
    }


    /**
     * HasMany Relation to: App\Eloquent\Kelas
     * 
     * @return mixed
     */
    public function kelas()
	{
		return $this->belongsToMany(Kelas::class, 'siswa_perkelas', 'siswa_id');
	}

}
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


    /**
     * BelongsToMany Relation to: App\Eloquent\Guru
     * this is a guru mapel for each mapel in the database
     * also based on that semester
     * 
     * @return mixed 
     */
    public function guru()
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel')->withPivot('semester');
    }


    /**
     * HasMany Relation to: App\Eloquent\KompetensiDasar
     * 
     * @return mixed
     */
    public function kompetensiDasar()
    {
        return $this->hasMany(KompetensiDasar::class, 'mapel_id');
    }


    /**
     * HasMany Relation to: App\Eloquent\NilaiPengetahuan
     * 
     * @return mixed
     */
    public function nilaiPengetahuan()
    {
        return $this->hasMany(NilaiPengetahuan::class, 'mapel_id');
    }


    /**
     * HasMany Relation to: App\Eloquent\NilaiKeterampilan
     * 
     * @return mixed
     */
    public function nilaiKeterampilan()
    {
        return $this->hasMany(NilaiKeterampilan::class, 'mapel_id');
    }


    /**
     * HasMany Relation to: App\Eloquent\NilaiSikap
     * 
     * @return mixed
     */
    public function nilaiSikap()
    {
        return $this->hasMany(NilaiSikap::class, 'mapel_id');
    }

}

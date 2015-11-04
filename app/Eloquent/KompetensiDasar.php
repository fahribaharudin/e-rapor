<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class KompetensiDasar extends Model
{

	/**
     * The database table used by the model.
     *
     * @var string
     */   
    protected $table = 'kompetensi_dasar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_kompetensi', 'semester'];

    /**
     * Disable Timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * BelongsToMany Relation to: App\Eloquent\Mapel
     * 
     * @return mixed 
     */
    public function mapel()
    {
    	return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}

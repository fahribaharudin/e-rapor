<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\ModelTrait\HasMapelParent;

class MapelWajib extends Model
{
	
	use HasMapelParent;

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mapel_wajib';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_mapel'];

    /**
     * Disable timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

}

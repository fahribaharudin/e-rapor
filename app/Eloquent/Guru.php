<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\ModelTrait\HasUserAccount;

class Guru extends Model
{

    use HasUserAccount;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'guru';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'nip'];

    /**
     * Disable timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;


    /**
     * BelongsToMany Relation to: App\Eloquent\Mapel
     * if the guru is a guru mapel then this method returning
     * the mapel that guru teaching for. 
     * 
     * @return mixed 
     */
    public function mapel()
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel')->withPivot('semester');;
    }


    /**
     * Hasmany Relation to: App\Eloquent\Kelas
     * 
     * @return mixed 
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }
}

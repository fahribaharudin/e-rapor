<?php 

namespace App\Eloquent\ModelTrait;

use App\Eloquent\Mapel;

trait HasMapelParent 
{

	/**
     * MorphOne relation to: App\Eloquent\Mapel
     * 
     * @return mixed 
     */
	public function mapelParent()
	{
		return $this->morphOne(Mapel::class, 'child');
	}

}
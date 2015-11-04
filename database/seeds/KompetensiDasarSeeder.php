<?php

use Illuminate\Database\Seeder;

use App\Eloquent;

class KompetensiDasarSeeder extends Seeder
{

	/**
	 * Mapel Eloquent Model
	 * 
	 * @var App\Eloquent\Mapel
	 */
	protected $mapel;

	/**
	 * KompetensiDasar Eloquent Model
	 * 
	 * @var App\Eloquent\KompetensiDasar
	 */
	protected $kompetensi_dasar;


	/**
	 * Class Constructor!
	 * 
	 * @param Eloquent\KompetensiDasar $kd    
	 * @param Eloquent\Mapel           $mapel 
	 */
	public function __construct(Eloquent\KompetensiDasar $kd, Eloquent\Mapel $mapel)
	{
		$this->kompetensi_dasar = $kd;
		$this->kompetensi_dasar->truncate();

		$this->mapel = $mapel;
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach ($this->mapel->all() as $mapel) {
    		$this->createKompetensi($mapel);
    	}
    }


    /**
     * Createa Kompetensi on the database
     * 
     * @param  App\Eloquent\Mapel $mapel 
     * @return mixed        
     */
    protected function createKompetensi($mapel)
    {
    	foreach (explode(',', $mapel->semester) as $semester) {
    	 	for ($i=1; $i<=3; $i++) {
	    	 	$kd = $this->kompetensi_dasar->create([
	    	 		'nama_kompetensi' => 'Kompetensi Dasar ' . $i,
	    	 		'mapel_id' => $mapel->id, 
	    	 		'semester' => $semester
	    	 	]);
    	 	}
		}
    }
}

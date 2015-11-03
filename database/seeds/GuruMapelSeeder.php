<?php

use Illuminate\Database\Seeder;

use App\Repositories\MapelRepository;
use App\Eloquent;

class GuruMapelSeeder extends Seeder
{

	protected $mapelRepo;

	/**
	 * Class Constructor!
	 */
	public function __construct(MapelRepository $mapelRepo)
	{
		DB::table('guru_mapel')->truncate();

		$this->mapelRepo = $mapelRepo;
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$allMapel = $this->mapelRepo->getByPaketKeahlian(4);

    	// Guru mapel available = 43
    	foreach ($allMapel as $mapel) {
    		if ($mapel->id == 64) {
    			foreach (explode(',', $mapel->semester) as $semester) {
		    		if ($semester == 1) {
			    		$mapel->guru()->attach(43, ['semester' => '1']);
		    		} elseif ($semester == 2) {
			    		$mapel->guru()->attach(43, ['semester' => '2']);
		    		} elseif ($semester == 3) {
			    		$mapel->guru()->attach(44, ['semester' => '3']);
		    		} elseif ($semester == 4) {
			    		$mapel->guru()->attach(44, ['semester' => '4']);
		    		} elseif ($semester == 5) {
			    		$mapel->guru()->attach(45, ['semester' => '5']);
		    		} elseif ($semester == 6) {
			    		$mapel->guru()->attach(45, ['semester' => '6']);
		    		}
    			}
    		} elseif ($mapel->id == 75) {
    			foreach (explode(',', $mapel->semester) as $semester) {
    				if (in_array(1, explode(',', $mapel->semester)) && $semester == 1) {
    					$mapel->guru()->attach(46, ['semester' => '1']);
    				} elseif (in_array(2, explode(',', $mapel->semester)) && $semester == 2) {
    					$mapel->guru()->attach(46, ['semester' => '2']);
    				} elseif (in_array(3, explode(',', $mapel->semester)) && $semester == 3) {
    					$mapel->guru()->attach(47, ['semester' => '3']);
    				} elseif (in_array(4, explode(',', $mapel->semester)) && $semester == 4) {
    					$mapel->guru()->attach(47, ['semester' => '4']);
    				} elseif (in_array(5, explode(',', $mapel->semester)) && $semester == 5) {
    					$mapel->guru()->attach(48, ['semester' => '5']);
    				} elseif (in_array(6, explode(',', $mapel->semester)) && $semester == 6) {
    					$mapel->guru()->attach(48, ['semester' => '6']);
    				}
    			}
    		}
    	}
    }
}

<?php

use Illuminate\Database\Seeder;

use App\Repositories\MapelRepository;
use App\Eloquent;

class GuruMapelSeeder extends Seeder
{

    /**
     * Mapel Repository
     * 
     * @var App\Repositories\MapelRepository
     */
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
    	// all mapel
        $allMapel = $this->mapelRepo->getByPaketKeahlian(4);

        // take guru_id from 43
    	$guru_id = 43;

    	foreach ($allMapel as $mapel) {
            // for RPL only (64 - 89)
            if ($mapel->id >= 64 && $mapel->id <= 89) {
    			foreach (explode(',', $mapel->semester) as $semester) {

                    if (in_array(1, explode(',', $mapel->semester)) && $semester == 1) {
                        $mapel->guru()->attach($guru_id, ['semester' => '1']);
                    } 
                    elseif (in_array(2, explode(',', $mapel->semester)) && $semester == 2) {
                        $mapel->guru()->attach($guru_id, ['semester' => '2']);
                    }    
                    else if (in_array(3, explode(',', $mapel->semester)) && $semester == 3) {
                        $mapel->guru()->attach($guru_id + 1, ['semester' => '3']);
                    } 
                    elseif (in_array(4, explode(',', $mapel->semester)) && $semester == 4) {
                        $mapel->guru()->attach($guru_id + 1, ['semester' => '4']);
                    }   
                    elseif (in_array(5, explode(',', $mapel->semester)) && $semester == 5) {
                        $mapel->guru()->attach($guru_id + 2, ['semester' => '5']);
                    } 
                    elseif (in_array(5, explode(',', $mapel->semester)) && $semester == 6) {
                        $mapel->guru()->attach($guru_id + 2, ['semester' => '6']);
                    }

    			}
                $guru_id = $guru_id + 3;
            } 
    	}
    }
}

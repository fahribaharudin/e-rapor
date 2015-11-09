<?php

use Illuminate\Database\Seeder;

use App\Eloquent;

class NilaiSeeder extends Seeder
{
	protected $mapel;
	protected $siswa;
	protected $kelas;
	protected $kompetensi_dasar;
	protected $nilai_pengetahuan;
	protected $nilai_keterampilan;
	protected $nilai_sikap;

	public function __construct()
	{
		$this->mapel = new Eloquent\Mapel;
		$this->siswa = new Eloquent\Siswa;
		$this->kelas = new Eloquent\Kelas;
		$this->kompetensi_dasar = new Eloquent\KompetensiDasar;
		$this->nilai_pengetahuan = new Eloquent\NilaiPengetahuan;
		$this->nilai_keterampilan = new Eloquent\NilaiKeterampilan;
		$this->nilai_sikap = new Eloquent\NilaiSikap;

		$this->nilai_pengetahuan->truncate();
		$this->nilai_keterampilan->truncate();
		$this->nilai_sikap->truncate();
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->kelas->all() as $kelas) {
        	if (count($kelas->siswa) != 0) {
			    switch ($kelas->tingkat_kelas) {
					case 1:
			  			for ($i=1; $i <= 2; $i++) {
			  				var_dump('================================================');
			  				var_dump($kelas->nama_kelas . ' semester - ' . $i);
			  				var_dump('================================================');
			  				foreach ($kelas->paketKeahlian->mapel as $mapel) {
			  					if (in_array($i, explode(',', $mapel->semester))) {
			  						if (count($mapel->guru) != 0) {
						  				var_dump('-------------------------------------------------');
				  						var_dump($mapel->child->nama_mapel);
						  				var_dump('-------------------------------------------------');
						  				foreach ($mapel->kompetensiDasar as $kompetensiDasar) {
						  					if ($kompetensiDasar->semester == $i) {
							  					var_dump($kompetensiDasar->nama_kompetensi);
						  					}
						  				}
			  						}
			  					}
			  				}
			  			}
						break;
					case 2:
						for ($i=3; $i <= 4; $i++) { 
				      		var_dump($kelas->nama_kelas . ' semester - ' . $i);
				      	}
						break;
					case 3:
		  		     	for ($i=5; $i <= 6; $i++) { 
		  		      		var_dump($kelas->nama_kelas . ' semester - ' . $i);
		  		      	}
						break;
				}
        	}
        }
    }
}

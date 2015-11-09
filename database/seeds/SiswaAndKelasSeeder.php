<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Siswa, App\Eloquent\Kelas, App\Eloquent\PaketKeahlian;
use Faker\Generator;

class SiswaAndKelasSeeder extends Seeder
{

	/**
	 * Siswa Eloquent Model
	 * 
	 * @var App\Eloquent\Siswa
	 */
	protected $siswa;

	/**
	 * Kelas Eloquent Model
	 * 
	 * @var App\Eloquent\Kelas
	 */
	protected $kelas;

	/**
	 * PaketKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\PaketKeahlian
	 */
	protected $paket;

	/**
	 * Faker Service
	 * 
	 * @var Faker\Generator
	 */
	protected $faker;


	/**
	 * Class Constructor!
	 * 
	 * @param Siswa $siswa 
	 * @param Kelas $kelas 
	 */
	public function __construct(Siswa $siswa, Kelas $kelas, PaketKeahlian $paket, Generator $faker)
	{
		$this->siswa = $siswa;
		$this->siswa->truncate();

		$this->kelas = $kelas;
		$this->kelas->truncate();

		$this->paket = $paket;

		DB::table('siswa_perkelas')->truncate();

		$this->faker = $faker;
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSiswa();
        $this->craeteKelas();
      	
      	// RPL-1 tingkat 1
      	$kelas1 = $this->kelas->find(19);
      	$kelas1->siswa()->attach([31, 32, 33, 34, 35]);

      	// RPL-2 tingkat 1
      	$kelas2 = $this->kelas->find(22);
      	$kelas2->siswa()->attach([36, 37, 38, 39, 40]);

      	// TKJ-1 tingkat 1
      	$kelas3 = $this->kelas->find(25);
      	$kelas3->siswa()->attach([41, 42, 43, 44, 45]);

      	// TKJ-2 tingkat 1
      	$kelas4 = $this->kelas->find(28);
      	$kelas4->siswa()->attach([46, 47, 48, 49, 50]);
    }


    /**
     * Create some siswa in the database
     * 
     * @return array 
     */
    protected function createSiswa($jumlahSiswa = 10)
    {
    	$siswa = [];
    	$nis = 100000;
    	$nisn = 200000;
    	foreach ($this->paket->all() as $paket) {
    		for ($i=1; $i<=$jumlahSiswa; $i++) {
	    		$siswa[] = $this->siswa->create([
	    			'paket_id' => $paket->id,
	    			'nis' => (string) $nis++,
	    			'nisn' => (string) $nisn++,
	    			'nama' => $this->faker->name,
	    			'tempat_lahir' => $this->faker->city,
	    			'tanggal_lahir' => '1993-11-16',
	    			'jenis_kelamin' => ($nis % 2) == 0 ? 'L' : 'P',
	    			'agama' => 'ISLAM',
	    			'status_dalam_kel' => 'Anak Kandung',
	    			'anak_ke' => '3',
	    			'alamat_siswa' => $this->faker->address,
	    			'sekolah_asal' => $this->faker->word,
	    			'diterima_kelas' => '1',
	    			'diterima_tanggal' => '2015-10-28',
	    			'nama_ayah' => $this->faker->name,
	    			'nama_ibu' => $this->faker->name,
	    			'alamat_ortu' => $this->faker->address,
	    		]);
    		}
    	}

    	return $siswa;
    }


    /**
     * Create some kelas in database
     * 
     * @return array 
     */
    public function craeteKelas()
    {
    	$kelas = [];

    	foreach ($this->paket->all() as $paket) {
			switch ($paket->id) {
				case 1:
					$kelas[] = $this->createKelasForPaket(['paket_id' => $paket->id, 'nama_kelas' => 'AK', 2, 10]);

					break;

				case 2:
					$kelas[] = $this->createKelasForPaket(['paket_id' => $paket->id, 'nama_kelas' => 'AP'], 2, 16); 

					break;

				case 3:
					$kelas[] = $this->createKelasForPaket(['paket_id' => $paket->id, 'nama_kelas' => 'PM'], 2, 22); 

					break;

				case 4:
					$kelas[] = $this->createKelasForPaket(['paket_id' => $paket->id, 'nama_kelas' => 'RPL'], 2, 28); 

					break;

				case 5:
					$kelas[] = $this->createKelasForPaket(['paket_id' => $paket->id, 'nama_kelas' => 'TKJ'], 2, 34);

					break;

				case 6:
					$kelas[] = $this->createKelasForPaket(['paket_id' => $paket->id, 'nama_kelas' => 'MM'], 1, 40);

					break;
			}

    	}

    	$newKelas = [];
    	foreach ($kelas as $kelas_array) {
    		$newKelas = array_merge($newKelas, $kelas_array);
    	}

    	return $newKelas;
    }


    /**
     * Create Kelas for specific PaketKeahlian
     * @param  array  $data 
     * @return array       
     */
    protected function createKelasForPaket(array $data, $jumlahKelas = 2, $guru_id = 10)
    {
    	$kelas = [];

    	for ($i=1; $i<=$jumlahKelas; $i++) {	
			for ($j=1; $j <= 3; $j++) { 
				$kelas[] = $this->kelas->create([
					'paket_id' => $data['paket_id'], 
					'guru_id' => $guru_id++, 
					'nama_kelas' => $data['nama_kelas'] . '-' . $i, 
					'tingkat_kelas' => $j
				]);
			}
		}

		return $kelas;
    }
}

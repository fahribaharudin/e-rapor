<?php

use Illuminate\Database\Seeder;
use App\Eloquent\BidangKeahlian, App\Eloquent\ProgramKeahlian, App\Eloquent\PaketKeahlian;

class DataKeahlianSeeder extends Seeder
{

	/**
	 * BidangKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\BidangKeahlian
	 */
	protected $bidangKeahlian;

	/**
	 * ProgramKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\ProgramKeahlian
	 */
	protected $programKeahlian;

	/**
	 * PaketKeahlian Eloquent Model
	 * 
	 * @var App\Eloquent\PaketKeahlian
	 */
	protected $paketKeahlian;

	/**
	 * Class Constructor!
	 * 
	 * @param BidangKeahlian  $bidang  
	 * @param ProgramKeahlian $program 
	 * @param PaketKeahlian   $paket   
	 */
	public function __construct(BidangKeahlian $bidang, ProgramKeahlian $program, PaketKeahlian $paket)
	{
		$this->paketKeahlian = $paket;
		$this->paketKeahlian->truncate();

		$this->programKeahlian = $program;
		$this->programKeahlian->truncate();

		$this->bidangKeahlian = $bidang;
		$this->bidangKeahlian->truncate();
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidang = $this->createBidangKeahlian();
        $program = $this->createProgramKeahlian();
        $paket = $this->createPaketKeahlian();
    }


    /**
     * Create some BidangKeahlian on database
     * 
     * @return Array 
     */
    protected function createBidangKeahlian() 
    {
    	$bidang = [
    		['nama' => 'Bisnis dan Manajemen'],
    		['nama' => 'Teknologi Informasi dan Komunikasi'],
    	];

    	$bidang_array = [];

    	foreach ($bidang as $b) {
    		$bidang_array[] = $this->bidangKeahlian->create($b);
    	}

    	return $bidang_array;
    }


    /**
     * Create some ProgramKeahlian on database
     * 
     * @return Array 
     */
    protected function createProgramKeahlian()
    {
    	$program = [
    		['bidang_id' => 1, 'nama' => 'Keuangan'],
    		['bidang_id' => 1, 'nama' => 'Administrasi'],
    		['bidang_id' => 1, 'nama' => 'Tata Niaga'],
    		['bidang_id' => 2, 'nama' => 'Teknik Komputer dan Informatika'],
    	];

    	$program_array = [];

    	foreach ($program as $p) {
    		$program_array[] = $this->programKeahlian->create($p);
    	}

    	return $program_array;
    }

    /**
     * Create some PaketKeahlian on database
     * 
     * @return Array 
     */
    protected function createPaketKeahlian()
    {
    	$paket = [
    		['program_id' => 1, 'nama' => 'Akuntansi'],
    		['program_id' => 2, 'nama' => 'Administrasi Perkantoran'],
    		['program_id' => 3, 'nama' => 'Pemasaran'],
    		['program_id' => 4, 'nama' => 'Rekayasa Perangkat Lunak'],
    		['program_id' => 4, 'nama' => 'Teknik Komputer dan Jaringan'],
    		['program_id' => 4, 'nama' => 'Multimedia'],
    	];

    	$paket_array = [];

    	foreach ($paket as $p) {
    		$paket_array[] = $this->paketKeahlian->create($p);
    	}

    	return $paket_array;
    }
}

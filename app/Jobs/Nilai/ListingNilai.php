<?php

namespace App\Jobs\Nilai;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories;
use App\Eloquent;

class ListingNilai extends Job implements SelfHandling
{
    
    /**
     * Mapel Repository
     * 
     * @var App\Repositories\MapelRepository
     */
    protected $mapelRepo;

    /**
     * Kelas Repository
     * 
     * @var App\Repositories\KelasRepository
     */
    protected $kelasRepo;

    /**
     * @var integer
     */
    protected $mapel_id;

    /**
     * @var integer
     */
    protected $kelas_id;

    /**
     * @var integer
     */
    protected $semester;

    /**
     * Container for the data of nilai pengetahuan
     * 
     * @var array
     */
    protected $data_nilai = [];


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mapel_id, $kelas_id, $semester)
    {
        $this->mapelRepo = new Repositories\MapelRepository(new Eloquent\Mapel, new Eloquent\PaketKeahlian);
        $this->kelasRepo = new Repositories\KelasRepository(new Eloquent\Kelas);
        $this->mapel_id = $mapel_id;
        $this->kelas_id = $kelas_id;
        $this->semester = $semester;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->data_nilai['mapel'] = $this->mapelRepo->getOne($this->mapel_id);
        $this->data_nilai['kelas'] = $this->kelasRepo->getOne($this->kelas_id);
        $this->data_nilai['kelas']->semester = $this->semester;
        $this->data_nilai['kelas']->siswa_kelas = $this->data_nilai['kelas']->siswa;
        $this->data_nilai['nilaiFormater'] = new \App\Services\NilaiFormater;

        return $this->data_nilai;
    }

}

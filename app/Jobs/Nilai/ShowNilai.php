<?php

namespace App\Jobs\Nilai;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories;
use App\Eloquent;

class ShowNilai extends Job implements SelfHandling
{

    protected $mapelRepo;

    protected $kelasRepo;

    protected $siswaRepo;

    protected $mapel_id;

    protected $kelas_id;

    protected $semester;

    protected $siswa_id;

    protected $data_nilai_pengetahuan = [];

    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mapel_id, $kelas_id, $semester, $siswa_id)
    {
        $this->mapelRepo = new Repositories\MapelRepository(new Eloquent\Mapel, new Eloquent\PaketKeahlian);
        $this->kelasRepo = new Repositories\KelasRepository(new Eloquent\Kelas);
        $this->siswaRepo = new Repositories\SiswaRepository(new Eloquent\Siswa);
        $this->mapel_id = $mapel_id;
        $this->kelas_id = $kelas_id;
        $this->semester = $semester;
        $this->siswa_id = $siswa_id;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->data_nilai_pengetahuan['mapel'] = $this->mapelRepo->getOne($this->mapel_id);
        $this->data_nilai_pengetahuan['mapel']->kompetensi_dasar = $this->data_nilai_pengetahuan['mapel']
            ->kompetensiDasar()
            ->where('semester', '=', $this->semester)
            ->get();
        $this->data_nilai_pengetahuan['siswa'] = $this->siswaRepo->getOne($this->siswa_id);
        $this->data_nilai_pengetahuan['siswa']->kelas = $this->kelasRepo->getOne($this->kelas_id);
        $this->data_nilai_pengetahuan['siswa']->semester = $this->semester;

        return $this->data_nilai_pengetahuan;
    }

}

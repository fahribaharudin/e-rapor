<?php

namespace App\Jobs\Nilai;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories;
use App\Eloquent;

class UpdateNilai extends Job implements SelfHandling
{
    
    /**
     * Data akademik for the related nilai info
     * 
     * @var array
     */
    protected $data_akademik = [];

    /**
     * The type of this nilai
     * 
     * @var string
     */
    protected $type;

    /**
     * Request data comes from the http request
     * 
     * @var array
     */
    protected $request_data;

    /**
     * Mapel Repository
     * 
     * @var App\Repositories\MapelRepository
     */
    protected $mapelRepo;

    /**
     * Nilai Repository
     * 
     * @var App\Repositories\NilaiRepository
     */
    protected $nilaiRepo;

    /**
     * The Nilai!
     * 
     * @var array
     */
    protected $nilai = [];


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($siswa_id, $mapel_id, $kelas_id, $semester, $request_data, $type)
    {
        $this->data_akademik['siswa_id'] = $siswa_id;
        $this->data_akademik['mapel_id'] = $mapel_id;
        $this->data_akademik['kelas_id'] = $kelas_id;
        $this->data_akademik['semester'] = $semester;

        $this->type = $type;
        
        $this->request_data = $request_data;
        
        $this->mapelRepo = new Repositories\MapelRepository(new Eloquent\Mapel, new Eloquent\PaketKeahlian);
        $this->nilaiRepo = new Repositories\NilaiRepository(
            $this->mapelRepo, 
            new Eloquent\NilaiPengetahuan, 
            new Eloquent\NilaiKeterampilan, 
            new Eloquent\NilaiSikap
        );

        $this->nilai = [
            $this->type => [
                'siswa_id' => $this->data_akademik['siswa_id'],
                'mapel_id' => $this->data_akademik['mapel_id'],
                'semester' => $this->data_akademik['semester'],
            ]
        ];
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mapel = $this->mapelRepo->getOne($this->data_akademik['mapel_id']);
        $kompetensiDasar = $mapel->kompetensiDasar()
            ->where('semester', '=', $this->data_akademik['semester'])
            ->get();

        $this->createNilai($kompetensiDasar);
        
        return $this->nilaiRepo->update($this->nilai);
    }


    /**
     * Create a collection of nilai from the request data
     * 
     * @param  Eloquent\KompetensiDasar $kompetensiDasar 
     * @return void                  
     */
    protected function createNilai($kompetensiDasar)
    {
        $index = 1;

        foreach ($kompetensiDasar as $kompetensi_dasar) {
            switch ($this->type) {
                case 'pengetahuan':
                    $this->formatNilaiPengetahuanToArray($index);               

                    break;

                case 'keterampilan':
                    $this->formatNilaiKeterampilanToArray($index);               

                    break;

                case 'sikap':
                    $this->formatNilaiSikapToArray($index);               

                    break;
            }

            $index++;
        }
    }


    /**
     * Format nilai pengetahuan to Array
     * 
     * @return void 
     */
    protected function formatNilaiPengetahuanToArray($index)
    {
        if (array_key_exists('nilai_tertulis_kd_' . $index, $this->request_data)) {
            $this->nilai['pengetahuan']['tertulis']['kd_' . $index] = 
            $this->request_data['nilai_tertulis_kd_' . $index];
        }
        if (array_key_exists('nilai_tertulis_kd_' . $index, $this->request_data)) {
            $this->nilai['pengetahuan']['observasi']['kd_' . $index] = 
            $this->request_data['nilai_observasi_kd_' . $index];
        }
        if (array_key_exists('nilai_tertulis_kd_' . $index, $this->request_data)) {
            $this->nilai['pengetahuan']['penugasan']['kd_' . $index] = 
            $this->request_data['nilai_penugasan_kd_' . $index];
        }
    }



    /**
     * Format nilai keterampilan to Array
     * 
     * @return void 
     */
    protected function formatNilaiKeterampilanToArray($index)
    {
        if (array_key_exists('nilai_praktek_kd_' . $index, $this->request_data)) {
            $this->nilai['keterampilan']['praktek']['kd_' . $index] = 
            $this->request_data['nilai_praktek_kd_' . $index];
        }
        if (array_key_exists('nilai_project_kd_' . $index, $this->request_data)) {
            $this->nilai['keterampilan']['project']['kd_' . $index] = 
            $this->request_data['nilai_project_kd_' . $index];
        }
        if (array_key_exists('nilai_produk_kd_' . $index, $this->request_data)) {
            $this->nilai['keterampilan']['produk']['kd_' . $index] = 
            $this->request_data['nilai_produk_kd_' . $index];
        }
        if (array_key_exists('nilai_portofolio_kd_' . $index, $this->request_data)) {
            $this->nilai['keterampilan']['portofolio']['kd_' . $index] = 
            $this->request_data['nilai_portofolio_kd_' . $index];
        }
        if (array_key_exists('nilai_tertulis_kd_' . $index, $this->request_data)) {
            $this->nilai['keterampilan']['tertulis']['kd_' . $index] = 
            $this->request_data['nilai_tertulis_kd_' . $index];
        }
    }


    /**
     * Format nilai pengetahuan to Array
     * 
     * @return void 
     */
    protected function formatNilaiSikapToArray($index)
    {
        if (array_key_exists('nilai_observasi_kd_' . $index, $this->request_data)) {
            $this->nilai['sikap']['observasi']['kd_' . $index] = 
            $this->request_data['nilai_observasi_kd_' . $index];
        }
        if (array_key_exists('nilai_penilaian_diri_kd_' . $index, $this->request_data)) {
            $this->nilai['sikap']['penilaian_diri']['kd_' . $index] = 
            $this->request_data['nilai_penilaian_diri_kd_' . $index];
        }
        if (array_key_exists('nilai_penilaian_sebaya_kd_' . $index, $this->request_data)) {
            $this->nilai['sikap']['penilaian_sebaya']['kd_' . $index] = 
            $this->request_data['nilai_penilaian_sebaya_kd_' . $index];
        }
        if (array_key_exists('nilai_jurnal_kd_' . $index, $this->request_data)) {
            $this->nilai['sikap']['jurnal']['kd_' . $index] = 
            $this->request_data['nilai_jurnal_kd_' . $index];
        } 
    }

}

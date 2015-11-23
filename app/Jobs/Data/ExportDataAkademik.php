<?php

namespace App\Jobs\Data;

use Illuminate\Contracts\Bus\SelfHandling;
use App\Eloquent;
use App\Repositories;
use Excel;

class ExportDataAkademik extends ExportDataAbstract implements SelfHandling
{
    
    /**
     * Excel writer driver
     * 
     * @var LaravelExcelWriter
     */
    protected $kelasListExport;

    /**
     * Paket keahlian repository
     * 
     * @var App\Repostiories\PaketKeahlian
     */
    protected $paketRepo;

    /**
     * Guru repostiry
     * 
     * @var App\Repositories\GuruRepitory
     */
    protected $guruRepo;

    /**
     * Kelas repository
     * 
     * @var App\Repositories\KelasRepository
     */
    protected $kelasRepo;

    /**
     * Collection from all loaded data
     * 
     * @var array
     */
    protected $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->paketRepo = new Repositories\PaketKeahlianRepository(
            new Eloquent\PaketKeahlian, 
            new Eloquent\BidangKeahlian
        );
        $this->kelasRepo = new Repositories\KelasRepository(new Eloquent\Kelas);
        $this->guruRepo = new Repositories\GuruRepository(new Eloquent\Guru);

        $this->kelasListExport = Excel::create('data_akademik', function($excel) {
            $this->setFileDescription($excel, ['title' => 'data akademik']);
        });
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataPaket = $this->loadDataPaket();
        $dataGuru = $this->loadDataGuru();
        $dataKelas = $this->loadDataKelas();
     
        $this->createSheetForPaket($dataPaket);
        $this->createSheetForGuru($dataGuru);
        $this->createSheetForKelas($dataKelas);

        return $this->kelasListExport->export('xlsx');
    }


    /**
     * Load all paket keahlian data from the database
     * 
     * @return array 
     */
    protected function loadDataPaket()
    {
        $this->data['paket'] = [];

        foreach ($this->paketRepo->getAll() as $paketKeahlian) {
            $this->data['paket'][] = [
                'id' => $paketKeahlian->id,
                'nama' => $paketKeahlian->nama,
            ];
        }

        return $this->data['paket'];
    }


    /**
     * Load data guru from the database
     * 
     * @return array 
     */
    protected function loadDataGuru()
    {
        $this->data['guru'] = [];
        foreach ($this->guruRepo->getAll() as $guru) {
            $this->data['guru'][] = [
                'Nip' => $guru->nip,
                'Nama' => $guru->nama
            ];
        }

        return $this->data['guru'];
    }
    

    /**
     * Load all kelas data from the database
     * 
     * @return array 
     */
    protected function loadDataKelas()
    {
        $this->data['kelas'] = [];

        $paket_count = count($this->data['paket']);
        $guru_count = count($this->data['guru']);

        foreach ($this->kelasRepo->getAll() as $kelas) {
            $this->data['kelas'][] = [
                'Nama Kelas' => $kelas->nama_kelas,
                'Tingkat Kelas' => $kelas->tingkat_kelas,
                'NIP Wali Kelas' => $kelas->waliKelas->nip,
                'Nama Wali Kelas' => "=VLOOKUP(C1, 'Data Guru'!A$2:B$1000,2)",
                'Id Paket Keahlian' => $kelas->paket_id,
                'Nama Paket Keahlian' => "=VLOOKUP(E1,'Data Paket Keahlian'!A$2:B$100,2)",
            ];
        }

        return $this->data['kelas'];
    }


    /**
     * Create a new "Data Kelas" sheet on the excel writer
     * 
     * @param  array $data 
     * @return void       
     */
    protected function createSheetForKelas($data)
    {
        $this->kelasListExport->sheet('Data Kelas', function($sheet) use ($data) {
            $sheet->fromArray($data, null, 'A1', false, false);

            $sheet->prependRow([
                'Nama Kelas', 
                'Tingkat Kelas', 
                'NIP Wali Kelas', 
                'Nama Wali Kelas', 
                'Id Paket Keahlian', 
                'Nama Paket Keahlian'
            ]);

            $sheet->cells('A1:F1', function($cells) {
                $cells->setFont([
                    'size' => '16',
                    'bold' => true,
                ]);
            });
        });
    }


    /**
     * Create a new "Data Paket Keahlian" sheet on the excel writer
     * 
     * @param  array $data 
     * @return void       
     */
    protected function createSheetForPaket($data)
    {
        $this->kelasListExport->sheet('Data Paket Keahlian', function($sheet) use ($data) {
            $sheet->fromArray($data, null, 'A1', false, false);

            $sheet->prependRow([
                'Id', 'Nama Paket Keahlian'
            ]);

            $sheet->cells('A1:B1', function($cells) {
                $cells->setFont([
                    'size' => '16',
                    'bold' => true
                ]);
            });
        });
    }


    /**
     * Create a new "Data Guru" sheet on the excel writer
     * 
     * @param  array $data 
     * @return void       
     */
    protected function createSheetForGuru($data)
    {
        $this->kelasListExport->sheet('Data Guru', function($sheet) use ($data) {
            $sheet->fromArray($data, null, 'A1', false, false);

            $sheet->prependRow([
                'NIP', 'Nama Guru'
            ]);

            $sheet->cells('A1:B1', function($cells) {
                $cells->setFont([
                    'size' => '16',
                    'bold' => true,
                ]);
            });
        });
    }

}

<?php

namespace App\Jobs\Data;

use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories;
use App\Eloquent;
use Excel, Faker;

class ExportDataSiswa extends ExportDataAbstract implements SelfHandling
{
    
    /**
     * Laravel excel writer
     * 
     * @var LaravelExcelWriter
     */
    protected $siswaListExport;

    /**
     * Kelas Repository
     * 
     * @var App\Repositories\KelasRepository
     */
    protected $kelasRepo;

    /**
     * Siswa Repository
     * 
     * @var App\Repositories\SiswaRepository
     */
    protected $siswaRepo;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->siswaListExport = Excel::create('data_siswa', function($excel) {
            $this->setFileDescription($excel, ['title' => 'Data semua siswa']);
        });

        $this->kelasRepo = new Repositories\KelasRepository(new Eloquent\Kelas);
        $this->siswaRepo = new Repositories\SiswaRepository(new Eloquent\Siswa);
    }

    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->loadDataKelas();
        $siswa = $this->loadDataSiswa();

        foreach ($siswa as $key => $value) {
            $this->createSheetForKelas($value, ['name' => $key]);
        }

        return $this->siswaListExport->export('xlsx');

    }


    /**
     * Load all kelas from the database
     * 
     * @return array
     */
    protected function loadDataKelas()
    {
        $this->data['kelas'] = [];
        foreach ($this->kelasRepo->getAll() as $kelas) {
            $this->data['kelas'][] = $kelas;
        }

        return $this->data['kelas'];
    }


    /**
     * Load data siswa from database
     * 
     * @return array 
     */
    protected function loadDataSiswa()
    {
        $this->data['siswa'] = [];

        foreach ($this->kelasRepo->getWithSiswa() as $kelas) {
            foreach ($kelas->siswa as $siswa) {
                $this->data['siswa']["{$kelas->nama_kelas} (tingkat {$kelas->tingkat_kelas})"][] = [
                    'kelas_id' => $kelas->id,
                    'nis' => $siswa->nis,
                    'nisn' => $siswa->nisn,
                    'nama_siswa' => $siswa->nama,
                    'tempat_lahir' => $siswa->tempat_lahir,
                    'tanggal_lahir' => $siswa->tanggal_lahir,
                    'jenis_kelamin' => $siswa->jenis_kelamin,
                    'alamat_siswa' => $siswa->alamat_siswa,
                ];
            }
            
            if (count($kelas->siswa->toArray()) == 0) {
                $this->data['siswa']["{$kelas->nama_kelas} (tingkat {$kelas->tingkat_kelas})"][] = [];
            }
        }

        return $this->data['siswa'];   
    }


    /**
     * Create a new "Data Kelas" sheet on the excel writer
     * this kelas contains all siswa on it
     * 
     * @param  array $data 
     * @return void       
     */
    protected function createSheetForKelas($data, $sheet_data)
    {  
        $this->siswaListExport->sheet($sheet_data['name'], function($sheet) use($data) {
            $sheet->fromArray($data, null, 'A1', false, false);

            $sheet->prependRow([
                'Id Kelas', 
                'NIS', 
                'NISN', 
                'Nama Siswa',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Jenis Kelamin',
                'Alamat Siswa',
            ]);

            $sheet->cells('A1:H1', function($cells) {
                $cells->setFont([
                    'bold' => true,
                ]);
            });
        });
    }

}

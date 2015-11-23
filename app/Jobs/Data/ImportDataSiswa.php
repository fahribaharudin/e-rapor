<?php

namespace App\Jobs\Data;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories;
use App\Eloquent;
use Excel, DB;

class ImportDataSiswa extends ImportDataAbstract implements SelfHandling
{

    protected $kelasRepo;

    protected $siswaRepo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imported_data)
    {
        $this->kelasRepo = new Repositories\KelasRepository(new Eloquent\Kelas);
        $this->siswaRepo = new Repositories\SiswaRepository(new Eloquent\Siswa);

        $this->readExcelFIle($imported_data);
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->saveDataSiswaToDatabase();
        
        return true;
    }


    /**
     * Handle importing data from an excel file to array collection
     * 
     * @param  LaravelExcelReader $excel 
     * @return void        
     */
    protected function importDataToArray($excel)
    {
        $result = $excel->get();

        $this->importedData['siswa'] = $result;
    }


    /**
     * Saving imported data siswa to the database
     * 
     * @return void 
     */
    protected function saveDataSiswaToDatabase()
    {
        set_time_limit(300);

        // truncaate the guru table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->siswaRepo->siswa->truncate();
        DB::table('siswa_perkelas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($this->importedData['siswa'] as $kelasSiswa) {
            foreach ($kelasSiswa as $siswa) {
                $kelas_db = $this->kelasRepo->kelas->find($siswa->id_kelas);
                if ($kelas_db != null) {
                    $siswa_db = $this->siswaRepo->siswa->where('nis', '=', $siswa->nis)
                        ->where('nisn', '=', $siswa->nisn)
                        ->first();
                    if ($siswa_db == null) {
                        $siswa = $this->siswaRepo->siswa->create([
                            'paket_id' => $kelas_db->paketKeahlian->id,
                            'nis' => $siswa->nis,
                            'nisn' => $siswa->nisn,
                            'nama' => $siswa->nama_siswa,
                            'tempat_lahir' => $siswa->tempat_lahir,
                            'jenis_kelamin' => $siswa->jenis_kelamin,
                            'alamat_siswa' => $siswa->alamat_siswa,
                        ]);
                    } else {
                        // UPDATE
                    }

                    $kelas_db->siswa()->attach($siswa->id);
                } 
            }
        }
    }
}

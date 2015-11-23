<?php

namespace App\Jobs\Data;

use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories;
use App\Eloquent;
use Excel, DB;

class ImportDataAkademik extends ImportDataAbstract implements SelfHandling
{

    /**
     * Paket kehalian repository
     * 
     * @var App\Repositories\PaketKeahlianRepository
     */
    protected $paketRepo;

    /**
     * Guru repository
     * 
     * @var App\Repositories\GuruRepository
     */
    protected $guruRepo;

    /**
     * Kelas repository
     * 
     * @var App\Repositories\KelasRepository
     */
    protected $kelasRepo;

    /**
     * Contains the result of reading uploaded excel file
     * 
     * @var array
     */
    protected $importedData = [];


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imported_data)
    {
        $this->paketRepo = new Repositories\PaketKeahlianRepository(
            new Eloquent\PaketKeahlian, 
            new Eloquent\BidangKeahlian
        );
        $this->guruRepo = new Repositories\GuruRepository(new Eloquent\Guru);
        $this->kelasRepo = new Repositories\KelasRepository(new Eloquent\Kelas);

        $this->readExcelFile($imported_data);
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->saveDataGuruToDatabase();
        $this->saveDataKelasToDatabase();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

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

        $this->importedData['paketKeahlian'] = $result[0];
        $this->importedData['guru'] = $result[1];
        $this->importedData['kelas'] = $result[2];
    }


    /**
     * Saving imported data guru to the database
     * 
     * @return void 
     */
    protected function saveDataGuruToDatabase()
    {   
        // truncaate the guru table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->guruRepo->guru->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($this->importedData['guru'] as $guru) {
            if ($this->guruRepo->guru->where('nip', '=', $guru->nip)->first() == null) {
                $this->guruRepo->guru->create([
                    'nama' => $guru->nama_guru,
                    'nip' => $guru->nip,
                ]);
            }
        }   
    }


    /**
     * Saving imported data guru to the database
     * 
     * @return void 
     */
    protected function saveDataKelasToDatabase() 
    {
        // truncaate the guru table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->kelasRepo->kelas->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($this->importedData['kelas'] as $kelas) {
            $guruValid = ($this->guruRepo->guru->where('nip', '=', $kelas->nip_wali_kelas)->first() != null);
            $paketValid = ($this->paketRepo->paketKeahlian->find($kelas->id_paket_keahlian) != null);

            if ($guruValid && $paketValid) {
                $guru_id = $this->guruRepo->guru->where('nip', '=', $kelas->nip_wali_kelas)->first()->id;
                $kelasExists = ($this->kelasRepo->kelas->where('nama_kelas', '=', $kelas->nama_kelas)
                    ->where('tingkat_kelas', '=', $kelas->tingkat_kelas)
                    ->where('guru_id', '=', $guru_id)
                    ->first() != null
                );

                if ( ! $kelasExists) {
                    $this->kelasRepo->kelas->create([
                        'paket_id' => $kelas->id_paket_keahlian,
                        'guru_id' => $guru_id,
                        'nama_kelas' => $kelas->nama_kelas,
                        'tingkat_kelas' => $kelas->tingkat_kelas,
                    ]);
                }
            }
        }
    }

}

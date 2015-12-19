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
     * Siswa repository
     * 
     * @var App\Repositories\SiswaRepository
     */
    protected $siswaRepo;

    /**
     * User repository
     * 
     * @var App\Repositories\UserRepository
     */
    protected $userRepo;

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
        $this->userRepo = new Repositories\UserRepository(
            new Eloquent\User, 
            new Eloquent\Administrator, 
            new Eloquent\Guru
        );
        $this->siswaRepo = new Repositories\SiswaRepository(new Eloquent\Siswa);

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
            $guru_db = $this->guruRepo->guru->where('nip', '=', $guru->nip)->first();
            if ($guru_db == null) {
                $guru_new = $this->guruRepo->guru->create([
                    'nama' => $guru->nama_guru,
                    'nip' => $guru->nip,
                ]);
            } else {
                $guru_db->userAccount->delete();    
            }
            
            $this->createGuruUser($guru_new);


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
        $this->siswaRepo->siswa->truncate();
        DB::table('siswa_perkelas')->truncate();
        $this->kelasRepo->kelas->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($this->importedData['kelas'] as $kelas) {
            $guru = $this->guruRepo->guru->where('nip', '=', $kelas->nip_wali_kelas)->first();
            $guruValid = ($guru != null);
            $paketValid = ($this->paketRepo->paketKeahlian->find($kelas->id_paket_keahlian) != null);

            if ($guruValid && $paketValid) {
                $kelasExists = ($this->kelasRepo->kelas->where('nama_kelas', '=', $kelas->nama_kelas)
                    ->where('tingkat_kelas', '=', $kelas->tingkat_kelas)
                    ->where('guru_id', '=', $guru->id)
                    ->first() != null
                );

                if ( ! $kelasExists) {
                    $this->kelasRepo->kelas->create([
                        'paket_id' => $kelas->id_paket_keahlian,
                        'guru_id' => $guru->id,
                        'nama_kelas' => $kelas->nama_kelas,
                        'tingkat_kelas' => $kelas->tingkat_kelas,
                    ]);
                    
                    $guru->userAccount->roles()->sync([2, 3]);
                }
            }
        }
    }


    /**
     * Create a new user for guru
     * 
     * @param  Eloquent $guru 
     * @return void       
     */
    protected function createGuruUser($guru)
    {
        $user = new Eloquent\User([
            'username' => $guru->nip,
            'password' => $guru->nip,
        ]);

        $user->owner()->associate($guru);
        $user->save();
        $user->roles()->attach(3);
    }

}

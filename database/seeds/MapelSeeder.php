<?php

use Illuminate\Database\Seeder;

use App\Eloquent; 

class MapelSeeder extends Seeder
{

    /**
     * Mapel Eloquent Model
     * 
     * @var App\Eloquent\Mapel
     */
	protected $mapel;

    /**
     * MapelWajib Eloquent Model
     * 
     * @var App\Eloquent\MapelWajib
     */
	protected $mapel_wajib;

    /**
     * MapelBidang Eloquent Model
     * 
     * @var App\Eloquent\MapelBidang
     */
	protected $mapel_bidang;

    /**
     * MapelProgram Eloquent Model
     * 
     * @var App\Eloquent\MapelProgram
     */
	protected $mapel_program;

    /**
     * MapelPaket Eloquent Model
     * 
     * @var App\Eloquent\MapelPaket
     */
	protected $mapel_paket;

    /**
     * PaketKeahlian Eloquent Model
     * 
     * @var App\Eloquent\PaketKeahlian
     */
	protected $paketKeahlian;


    /**
     * Class Constructor!
     * 
     * @param Eloquent\Mapel         $mapel         
     * @param Eloquent\MapelWajib    $mapel_wajib   
     * @param Eloquent\MapelBidang   $mapel_bidang  
     * @param Eloquent\MapelProgram  $mapel_program 
     * @param Eloquent\MapelPaket    $mapel_paket   
     * @param Eloquent\PaketKeahlian $paketKeahlian 
     */
	public function __construct(
		Eloquent\Mapel $mapel, 
		Eloquent\MapelWajib $mapel_wajib, 
		Eloquent\MapelBidang $mapel_bidang, 
		Eloquent\MapelProgram $mapel_program, 
		Eloquent\MapelPaket $mapel_paket,
		Eloquent\PaketKeahlian $paketKeahlian)
	{
		$this->mapel = $mapel;
		$this->mapel->truncate();

		$this->mapel_wajib = $mapel_wajib;
		$this->mapel_wajib->truncate();

		$this->mapel_bidang = $mapel_bidang;
		$this->mapel_bidang->truncate();

		$this->mapel_program = $mapel_program;
		$this->mapel_program->truncate();

		$this->mapel_paket = $mapel_paket;
		$this->mapel_paket->truncate();

		$this->paketKeahlian = $paketKeahlian;
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create mapel wajib on the child (MapelWajib)
        $mapelWajib = $this->createMapelWajib();
        
        // Create mapel bidang on the child (MapelBidang)
        $mapelBidang = $this->createMapelBidang(); 

        // Create mapel program on the child (MapelProgram)
        $mapelProgram = $this->createMapelProgram();

        // Create mapel paket on the child (MapelPaket)
        $mapelPaket = $this->createMapelPaket();

        foreach ($this->paketKeahlian->all() as $paket) {
            
            // Create mapel wajib on the parent (Mapel)
            $i = 1;
            foreach ($mapelWajib as $mapel) {
                $this->mapel->create([
                    'paket_id' => $paket->id, 
                    'child_type' => \App\Eloquent\MapelWajib::class, 
                    'child_id' => $mapel->id, 
                    'kelompok' => ($i++) <= 6 ? 'A' : 'B', 
                    'semester' => '1,2,3,4,5,6', 
                ]);
            }
        
            // Create mapel bidang on the parent (Mapel)
            foreach ($mapelBidang as $mapel) {
                $program = $paket->programKeahlian;
                $bidang = $program->bidangKeahlian;
                if ($mapel->bidang_id == $bidang->id) {
                    $this->mapel->create([
                        'paket_id' => $paket->id,
                        'child_type' => \App\Eloquent\MapelBidang::class,
                        'child_id' => $mapel->id,
                        'kelompok' => 'C1',
                        'semester' => '1,2,3,4',
                    ]);
                }
            }
         
            // Create mapel program on the parent (Mapel)
            foreach ($mapelProgram as $mapel) {
                if ($mapel->program_id == $paket->program_id) {
                    $this->mapel->create([
                        'paket_id' => $paket->id,
                        'child_type' => \App\Eloquent\MapelProgram::class,
                        'child_id' => $mapel->id,
                        'kelompok' => 'C2',
                        'semester' => '1,2',
                    ]);
                }
            }
            
            // Create mapel paket on the parent (Mapel)
            foreach ($mapelPaket as $mapel) {
                if ($mapel->paket_id == $paket->id) {
                    $this->mapel->create([
                        'paket_id' => $paket->id,
                        'child_type' => \App\Eloquent\MapelPaket::class,
                        'child_id' => $mapel->id,
                        'kelompok' => 'C3',
                        'semester' => '3,4,5,6',
                    ]);
                }
            }

        }
    }


    /**
     * Create some mapel wajib on the database
     * 
     * @return array 
     */
    protected function createMapelWajib()
    {
    	$mapelWajib = [
    		['nama_mapel' => 'Pendidikan Agama dan Budi Pekerti'],
    		['nama_mapel' => 'Pendidikan Pancasila dan Kewarganegaraan'],
    		['nama_mapel' => 'Bahasa Indonesia'],
    		['nama_mapel' => 'Matematika'],
    		['nama_mapel' => 'Sejarah Indonesia'],
    		['nama_mapel' => 'Bahasa Inggris'],
    		['nama_mapel' => 'Seni Budaya'],
    		['nama_mapel' => 'Prakarya dan Kewirausahaan (Kerajinan)'],
    		['nama_mapel' => 'Prakarya dan Kewirausahaan (Rekayasa)'],
    		['nama_mapel' => 'Prakarya dan Kewirausahaan (Budidaya)'],
    		['nama_mapel' => 'Pendidikan Jasmani, Olah Raga dan Kesehatan'],
    	];

    	$mapel_array = [];

    	foreach ($mapelWajib as $mapel) {
    		$mapel_array[] = $this->mapel_wajib->create($mapel);
    	}

    	return $mapel_array;
    }


    /**
     * Create some mapel bidang in the database
     * 
     * @return array 
     */
    protected function createMapelBidang()
    {
        $mapelBidang = [
            ['bidang_id' => '1', 'nama_mapel' => 'Pengantar Ekonomi dan Bisnis (Bisnis dan Manajemen)'],
            ['bidang_id' => '1', 'nama_mapel' => 'Pengantar Akuntansi (Bisnis dan Manajemen)'],
            ['bidang_id' => '1', 'nama_mapel' => 'Pengantar Administrasi Perkantoran (Bisnis dan Manajemen)'],
            ['bidang_id' => '2', 'nama_mapel' => 'Fisika (Teknologi Informasi dan Komunikasi)'],
            ['bidang_id' => '2', 'nama_mapel' => 'Pemrograman Dasar (Teknologi Informasi dan Komunikasi)'],
            ['bidang_id' => '2', 'nama_mapel' => 'Sistem Komputer (Teknologi Informasi dan Komunikasi)'],
        ];

        $mapel_array = [];

        foreach ($mapelBidang as $mapel) {
            $mapel_array[] = $this->mapel_bidang->create($mapel);
        }

        return $mapel_array;
    }


    /**
     * Create some mapel program in the database
     * 
     * @return array 
     */
    protected function createMapelProgram()
    {
        $mapelProgram = [
            ['program_id' => '1', 'nama_mapel' => 'Akuntansi Perusahaan Jasa'],
            ['program_id' => '1', 'nama_mapel' => 'Dasar-Dasar Perbankan'],
            ['program_id' => '1', 'nama_mapel' => 'Etika Profesi'],
            ['program_id' => '1', 'nama_mapel' => 'Paket Program Pengolah Angka/Spreadsheet'],
            ['program_id' => '3', 'nama_mapel' => 'Analisa dan Riset Pasar'],
            ['program_id' => '3', 'nama_mapel' => 'Pemasaran On-Line'],
            ['program_id' => '3', 'nama_mapel' => 'Pengelolaan Usaha Pemasaran'],
            ['program_id' => '3', 'nama_mapel' => 'Perencanaan Pemasaran'],
            ['program_id' => '3', 'nama_mapel' => 'Strategi Pemasaran'],
            ['program_id' => '4', 'nama_mapel' => 'Jaringan Dasar'],
            ['program_id' => '4', 'nama_mapel' => 'Pemrograman Web'],
            ['program_id' => '4', 'nama_mapel' => 'Perakitan Komputer'],
            ['program_id' => '4', 'nama_mapel' => 'Sistem Operasi'],
        ];

        $mapel_array = [];

        foreach ($mapelProgram as $mapel) {
            $mapel_array[] = $this->mapel_program->create($mapel);
        }

        return $mapel_array;
    }


    /**
     * Create some mapel paket in the database
     * 
     * @return array 
     */
    protected function createMapelPaket()
    {
        $mapelPaket = [
            ['paket_id' => '1', 'nama_mapel' => 'Administrasi Pajak'],
            ['paket_id' => '1', 'nama_mapel' => 'Akuntansi Keuangan'],
            ['paket_id' => '1', 'nama_mapel' => 'Akuntansi Perusahaan Dagang'],
            ['paket_id' => '1', 'nama_mapel' => 'Akuntansi Perusahaan Manufaktur'],
            ['paket_id' => '1', 'nama_mapel' => 'Komputer Akuntansi'],
            ['paket_id' => '3', 'nama_mapel' => 'Administrasi Barang'],
            ['paket_id' => '3', 'nama_mapel' => 'Administrasi Transaksi'],
            ['paket_id' => '3', 'nama_mapel' => 'Komunikasi Bisnis'],
            ['paket_id' => '3', 'nama_mapel' => 'Pelayanan Penjualan'],
            ['paket_id' => '3', 'nama_mapel' => 'Penataan Barang Dagangan'],
            ['paket_id' => '3', 'nama_mapel' => 'Pengetahuan Produk'],
            ['paket_id' => '3', 'nama_mapel' => 'Prinsip-Prinsip Bisnis'],
            ['paket_id' => '4', 'nama_mapel' => 'Administrasi Basis Data'],
            ['paket_id' => '4', 'nama_mapel' => 'Basis Data'],
            ['paket_id' => '4', 'nama_mapel' => 'Kerja Proyek'],
            ['paket_id' => '4', 'nama_mapel' => 'Pemodelan perangkat Lunak'],
            ['paket_id' => '4', 'nama_mapel' => 'Pemrograman Berorientasi Obyek'],
            ['paket_id' => '4', 'nama_mapel' => 'Pemrograman Grafik'],
            ['paket_id' => '4', 'nama_mapel' => 'Pemrograman Perangkat Bergerak'],
            ['paket_id' => '4', 'nama_mapel' => 'Pemrograman Web Dinamis'],
            ['paket_id' => '5', 'nama_mapel' => 'Administrasi Server'],
            ['paket_id' => '5', 'nama_mapel' => 'Jaringan Nirkabel'],
            ['paket_id' => '5', 'nama_mapel' => 'Keamanan Jaringan'],
            ['paket_id' => '5', 'nama_mapel' => 'Komputer Terapan Jaringan'],
            ['paket_id' => '5', 'nama_mapel' => 'Komunikasi Data'],
            ['paket_id' => '5', 'nama_mapel' => 'Rancang Bangun Jaringan'],
            ['paket_id' => '5', 'nama_mapel' => 'Sistem Operasi Jaringan'],
            ['paket_id' => '5', 'nama_mapel' => 'Troubleshooting Jaringan'],
            ['paket_id' => '6', 'nama_mapel' => 'Desain Multimedia'],
            ['paket_id' => '6', 'nama_mapel' => 'Desain Multimedia Interaktif'],
            ['paket_id' => '6', 'nama_mapel' => 'Komposisi Foto Digital'],
            ['paket_id' => '6', 'nama_mapel' => 'Pengolahan Citra Digital'],
            ['paket_id' => '6', 'nama_mapel' => 'Teknik Animasi 2 Dimensi'],
            ['paket_id' => '6', 'nama_mapel' => 'Teknik Animasi 3 Dimensi'],
            ['paket_id' => '6', 'nama_mapel' => 'Teknik Pengambilan Gambar Bergerak'],
            ['paket_id' => '6', 'nama_mapel' => 'Teknik Pengolahan Audio'],
            ['paket_id' => '6', 'nama_mapel' => 'Teknik Pengolahan Video'],
        ];

        $mapel_array = [];

        foreach ($mapelPaket as $mapel) {
            $mapel_array[] = $this->mapel_paket->create($mapel);
        }

        return $mapel_array;
    }

}

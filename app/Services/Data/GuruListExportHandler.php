<?php 

namespace App\Services\Data;

use Maatwebsite\Excel\Files\ExportHandler;
use App\Repositories\GuruRepository;

class GuruListExportHandler implements ExportHandler {

	protected $guruRepo;

	public function __construct(GuruRepository $guruRepo)
	{
		$this->guruRepo = $guruRepo;
	}

	public function handle($file) 
	{
		$file = $this->setIdentity($file);
		$data = $this->loadData();

		$file->sheet('Data Guru', function($sheet) use ($data) {
			$sheet->fromArray($data);
			$sheet->cells('A1:B1', function($cells) {
				$cells->setFont([
					'size' => '16',
					'bold' => true,
				]);
			});
		});

		return $file->export('xlsx');
	}

	protected function setIdentity(GuruListExport $file)
	{
		$file->setTitle('Data Guru SMK 1 Wonosobo Tahun Ajaran 2015')
			->setCreator('Fahri Baharudin')
			->setCompany('kenekono.com')
			->setDescription('Digunakan sebagai draft import data ke aplikasi e-Rapor');

		return $file;
	}

	protected function loadData()
	{
		$data = [];
		foreach ($this->guruRepo->getAll() as $guru) {
			$data[] = [
				'Nip' => $guru->nip,
				'Nama' => $guru->nama
			];
		}

		return $data;
	}

}
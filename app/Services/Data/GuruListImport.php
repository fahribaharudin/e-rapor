<?php 

namespace App\Services\Data;

use Maatwebsite\Excel\Files\ExcelFile;
use Illuminate\Http\Request;

class GuruListImport extends ExcelFile {

	public function getFile()
	{
		return storage_path('exports') . '/file_guru.xlsx';
	}

}
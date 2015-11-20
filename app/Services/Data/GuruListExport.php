<?php 

namespace App\Services\Data;

use Maatwebsite\Excel\Files\NewExcelFile;

class GuruListExport extends NewExcelFile {

	protected $fileName = 'file_guru';

	public function getFileName() 
	{
		return $this->fileName;
	}

}
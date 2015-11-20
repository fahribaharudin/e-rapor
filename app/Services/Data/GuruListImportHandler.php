<?php 

namespace App\Services\Data;

use Maatwebsite\Excel\Files\ImportHandler;

class GuruListImportHandler implements ImportHandler {

	public function handle($file)
	{
		$file->ignoreEmpty();

		return $file->get()->filter(function($data) {
			if ($data->nip != null) {
				return $data;
			}
		});
	}

}
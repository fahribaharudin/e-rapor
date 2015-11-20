<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\Data\GuruListExport;
use App\Services\Data\GuruListImport;

class DataController extends Controller {

    /**
     * Handle (GET) Request from: /admin/data/import
     * 
     * @return Response 
     */
	public function index() 
	{
		return view('admin.data-import-download.index');
	}


	/**
	 * Handle (GET) Request from: /admin/data/import/draft-guru
	 * 
	 * @param  GuruListExport $export 
	 * @return Response                 
	 */
	public function exportGuru(GuruListExport $export)
	{
		return $export->handleExport();
	}


	public function importGuru(GuruListImport $reader)
	{
		$reader->handleImport();
	}

}

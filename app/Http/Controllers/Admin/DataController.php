<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs;

class DataController extends Controller 
{

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
	 * Handle (GET) Request from: /admin/data/export-akademik
	 * 
	 * @return Response 
	 */
	public function exportAkademik()
	{
		$export = $this->dispatch(new Jobs\Data\ExportDataAkademik);
		
		return $export;
	}

	
	/**
	 * Handle (POST) Request from: /admin/data/import-akademik
	 * 
	 * @param  Request $request 
	 * @return Response           
	 */
	public function importAkademik(Request $request)
	{
		$import = $this->dispatchFrom(Jobs\Data\ImportDataAkademik::class, $request);

		if ($import) {
			$request->session()->flash('message', 'Data akademik berhasil di import');
		}
		
		return redirect()->back();		
	}


	/**
	 * Handle (GET) Request from: /admin/data/export-data-siswa
	 * 
	 * @return Response
	 */
	public function exportSiswa()
	{
		$export = $this->dispatch(new Jobs\Data\ExportDataSiswa);

		return $export;
	}


	/**
	 * Handle (POST) Request from: /admin/data/import-data-siswa
	 * 
	 * @param  Request $request 
	 * @return Response           
	 */
	public function importSiswa(Request $request)
	{
		$import = $this->dispatchFrom(Jobs\Data\ImportDataSiswa::class, $request);
		
		if ($import) {
			$request->session()->flash('message', 'Data siswa berhasil di import');
		}
		
		return redirect()->back();
	}

}

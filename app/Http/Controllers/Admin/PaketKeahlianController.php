<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PaketKeahlianRepository;

class PaketKeahlianController extends Controller
{

	/**
	 * Handle (GET) request from: /admin/paket-keahlian
	 * 
	 * @param  PaketKeahlianRepository $paketKeahlianRepo 
	 * @return Response                                     
	 */
    public function index(PaketKeahlianRepository $paketKeahlianRepo)
    {
    	$paketKeahlian = $paketKeahlianRepo->getAll();

    	return view('admin.paket-keahlian.index')->with(compact('paketKeahlian'));
    }
    
}

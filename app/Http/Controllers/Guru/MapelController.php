<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories;
use Auth;

class MapelController extends Controller
{

	/**
	 * Handle (GET) Request from: /guru/kelas/mapel
	 * 
	 * @param  Repositories\MapelRepository $mapelRepo 
	 * @return Response                                  
	 */
    public function index(Repositories\MapelRepository $mapelRepo)
    {
    	$mapels = $mapelRepo->getByPaketKeahlian(Auth::user()->owner->kelas[0]->paket_id);
    	
    	return view('guru.mapel.index')->with(compact('mapels'));
    }
    
}

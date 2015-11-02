<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MapelRepository;
use App\Repositories\PaketKeahlianRepository;
use App\Services\KeahlianSelectBoxGenerator as SelectBoxGenerator;
use App\Http\Controllers\Admin\ControllerTrait\SelectBoxFeed;

class MapelController extends Controller
{
   
    use SelectBoxFeed;

    /**
     * Handle (GET) Request from: /admin/mapel
     * 
     * @return Response 
     */
	public function index(SelectBoxGenerator $selectBoxGenerator)
	{
		return view('admin.mapel.index');
	}


	/**
	 * Handle (GET) Request from: /admin/mapel/paket
	 * 
	 * @param  integer          $paket_id  
	 * @param  MapelRepository $mapelRepo 
	 * @param  PaketKeahlianRepository $paketRepo 
	 * @return Response                     
	 */
	public function indexByPaket($paket_id, MapelRepository $mapelRepo, PaketKeahlianRepository $paketRepo)
	{
		$mapelByPaket = $mapelRepo->getByPaketKeahlian($paket_id);
		$mapelByPaket->paket_keahlian = $paketRepo->getOne($paket_id);

		return view('admin.mapel.index-byPaket')->with(compact('mapelByPaket'));
	}


}

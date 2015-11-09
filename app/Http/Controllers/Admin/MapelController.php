<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MapelRepository;
use App\Repositories\GuruRepository;
use App\Repositories\PaketKeahlianRepository;
use App\Services\SelectBoxGenerator as SelectBoxGenerator;
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


	/**
	 * Handle (GET) Request from: /admin/mapel/{mapel_id}/edit
	 * 
	 * @param  integer          $id        
	 * @param  MapelRepository $mapelRepo 
	 * @param  GuruRepository  $guruRepo  
	 * @return Response                     
	 */
	public function edit($id, MapelRepository $mapelRepo, GuruRepository $guruRepo)
	{
		$mapel = $mapelRepo->getOne($id);
		$semuaGuru = $guruRepo->getAll();

		return view('admin.mapel.edit')->with(compact('mapel', 'semuaGuru'));
	}


	/**
	 * Handle (PUT) Request from: /admin/mapel/{mapel_id}
	 * 
	 * @param  Request         $request   
	 * @param  MapelRepository $mapelRepo 
	 * @return Response                     
	 */
	public function update(Request $request, MapelRepository $mapelRepo)
	{
		// create rules for validation
		$rules = ['nama' => 'required', 'kelompok' => 'required'];
		for ($i=1; $i<=6; $i++) {
			if ($request->has('input_semester_' . $i)) {
				$rules['input_guru_semester_' . $i] = 'not_in:0'; 
			}
		}

		// validating the request
		$this->validate($request, $rules);

		$update = ($mapelRepo->update($request->get('id'), $request->except(['_token', '_method', 'id'])));

		if ($update) {
			return redirect()->route('admin.mapel.paket.index', $request->get('paket_id'));
		}
	}
}

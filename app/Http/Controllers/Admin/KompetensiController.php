<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MapelRepository;

class KompetensiController extends Controller
{
    public function index()
    {
    	return view('admin.kompetensi.index');
    }

    public function indexByMapel($mapel_id, MapelRepository $mapelRepo)
    {
    	$mapel = $mapelRepo->getKompetensiDasar($mapel_id)->toArray();

    	return view('admin.kompetensi.index-byMapel')->with(compact('mapel'));
    }
}

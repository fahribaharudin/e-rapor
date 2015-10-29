<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\KelasRepository;

class KelasController extends Controller
{
    
    /**
     * Handle (GET) Request from: /admin/kelas
     * 
     * @return Response 
     */
    public function index(KelasRepository $kelasRepository)
    {
    	$semuaKelas =  $kelasRepository->getAll();
    	
    	return view('admin.kelas.index')->with(compact('semuaKelas'));
    }

}

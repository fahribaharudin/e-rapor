<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\GuruRepository;

class GuruController extends Controller
{
	
	/**
	 * Handle (GET) Ajax Request from: /admin/guru-ajax
	 * 
	 * @return Response 
	 */    
	public function indexAjaxFeed(GuruRepository $guruRepository)
	{
		return $guruRepository->getAll();
	}


	/**
	 * Handle (GET) request from: /admin/guru
	 * 
	 * @return Response 
	 */
    public function index(GuruRepository $guruRepository)
    {
    	$semuaGuru = $guruRepository->getAll();

    	return view('admin.guru.index')->with(compact('semuaGuru'));
    }

}

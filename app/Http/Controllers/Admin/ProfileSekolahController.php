<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileSekolahController extends Controller
{
    
    /**
     * Handle (GET) request from: /admin/profile-sekolah
     * 
     * @return Response
     */
    public function index()
    {
    	return view('admin.profile-sekolah.index');
    }

}

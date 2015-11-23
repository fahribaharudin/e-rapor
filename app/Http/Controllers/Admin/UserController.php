<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{	

	/**
	 * Handle (GET) request from: /admin/users
	 * 
	 * @return Response 
	 */
    public function index(UserRepository $userRepository)
    {
    	$users = $userRepository->getAll();

    	return view('admin.users.index')->with(compact('users'));
    }


    public function create()
    {
    	return view('admin.users.create');
    }


    public function store(Request $request)
    {
    	return $request->all();
    }

}

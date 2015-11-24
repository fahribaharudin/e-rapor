<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories;

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


    /**
     * Handle (GET) Request from: /admin/users/create
     * 
     * @return Response
     */
    public function create()
    {
    	return view('admin.users.create');
    }


    /**
     * Handle (POST) Request from: /admin/users
     * 
     * @param  Request                     $request  
     * @param  Repositories\UserRepository $userRepo 
     * @return Response                                
     */
    public function store(Request $request, Repositories\UserRepository $userRepo)
    {
        $validator = [
            'nama' => ($request->get('level') == 'admin') ? 'required' : 'required|exists:guru,id',
            'username' => 'required|alpha_dash|unique:users,username',
            'password' => 'required',
        ];

        // validate request
        $this->validate($request, $validator);

        // create custom request
        if ($request->get('level') == 'admin') {
            $child = ['type' => 'admin', 'nama' => $request->get('nama')];
        } elseif ($request->get('level') == 'walas') {
            $child = ['type' => 'walas', 'nama' => $request->get('nama')];
        } elseif ($request->get('level') == 'guru') {
            $child = ['type' => 'guru', 'nama' => $request->get('nama')];
        }

        // create a new user on repo
        $user = $userRepo->create([ 
            'username' => $request->get('username'), 
            'password' => $request->get('password'),
            'level' => $request->get('level'),
            'child' => $child,
        ]);

        // create some response if success
        if ($user != null) {
            $request->session()->flash('message', 'User berhasil di tambah');

            return redirect()->route('admin.users.index');
        }
    }

}

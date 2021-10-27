<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;

class Save_userController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.password.verification')->only('create');
        // $this->middleware('user.password.verification')->only(['create','store']);
    }

    public function index()
    {

        return view('admin.save.Save_user');
    }
    public function create(UserRequest $request)
    {
        $user = new User;
        
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->newPassword);
        if(isset($request->is_admin)){
        $user->is_admin = $request->is_admin;
        }
        $user->save();
        flash('Usuario registrado com sucesso!')->success();
        return redirect()->route('Page_users');

        
        
    }
    public function edit($Save_user)
    {
        $userUnic = \App\User::find($Save_user);
        return view('admin.save.Edit_user', compact('userUnic'));
    }
    public function update(UserRequest $request, $userUnic)
    {
        $data = $request->all();
        $userU =\App\User::find($userUnic);
        $userU->update($data);

        return redirect()->route('Page_users');
    }   

}

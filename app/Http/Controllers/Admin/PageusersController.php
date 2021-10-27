<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageusersController extends Controller
{
    public function __construct()
    {
     //   $this->middleware('auth');
    }
    public function index()
    {
        $userAll = \App\User::paginate(10);

        
        return view('admin.page.Page_users')->with('userAll', $userAll);
    }
    public function destroy($Save_user) 
    {
        $userU =\App\User::find($Save_user);
        $userU->delete();

        flash('Registro do usuário apagado com sucesso!')->success();
        return redirect()->route('Page_users');
    }
}

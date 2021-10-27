<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        $lista = \App\Working_hour::all();

      //  return $lista;
        return view('manager_report',compact('lista'));
    }
    public function indexBlade(){
        $lista = \App\Working_hour::all();

      //  return $lista;
        return view('manager_reportB',compact('lista'));
    }
}

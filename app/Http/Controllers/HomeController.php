<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function form(){
        return view('nasabah/form-data_diri');
    }
}

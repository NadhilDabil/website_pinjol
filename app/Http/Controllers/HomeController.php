<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::check() && Auth::user()->role === 'admin'){
            $totalNasabah = Nasabah::count();
            $totalNasabahBaru = User::doesntHave('nasabah')->where('role','nasabah')->count();
            // $tunggakan = Peminjaman::doesntHave()->sum();

            $totalJumlahPinjaman = Nasabah::with('peminjaman')->get()->sum(function($nasabah) {
                return $nasabah->peminjaman->where('status', 'approve')->sum('jumlah_pinjaman');
            });

            return view('admin/admin-dashboard',compact('totalNasabah','totalNasabahBaru','totalJumlahPinjaman'));
        }

         return view('dashboard');

    }

    public function form(){
        return view('nasabah/form-data_diri');
    }
}

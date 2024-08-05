<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::check() && Auth::user()->role === 'admin'){
            $totalNasabah = Nasabah::count();
            $totalNasabahBaru = Nasabah::where('verified', false)->count();
            // $tunggakan = Peminjaman::doesntHave()->sum();

            $totalJumlahPinjaman = Nasabah::with('peminjaman')->get()->sum(function($nasabah) {
                return $nasabah->peminjaman->where('status', 'approve')->sum('jumlah_pinjaman');
            });

            return view('admin/admin-dashboard',compact('totalNasabah','totalNasabahBaru','totalJumlahPinjaman'));
        } else {
            $nasabah = Auth::user()->nasabah;
            return view('dashboard', compact('nasabah'));
        }


    }

    public function form(){
        return view('nasabah/form-data_diri');
    }
}

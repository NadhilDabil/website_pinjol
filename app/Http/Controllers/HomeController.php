<?php

namespace App\Http\Controllers;

use App\Models\FakturPeminjaman;
use App\Models\Nasabah;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $totalNasabah = Nasabah::count();
            $totalNasabahBaru = Nasabah::where('verified', false)->count();
            $totalTunggakan = FakturPeminjaman::sum('total_pinjaman');

            return view('admin/admin-dashboard', compact('totalNasabah', 'totalNasabahBaru', 'totalTunggakan'));
        } else {
            $nasabah = Auth::user()->nasabah;
            $peminjaman = Peminjaman::whereHas('fakturPeminjaman', fn ($query) => $query->where('nasabah_id', $nasabah?->id))
                ->whereDoesntHave('pembayaran')
                ->where('tanggal_mulai', '<=', now())
                ->orderBy('tanggal_mulai', 'asc')
                ->first();
            return view('dashboard', compact('nasabah','peminjaman'));
        }
    }

    public function form()
    {
        return view('nasabah/form-data_diri');
    }
}

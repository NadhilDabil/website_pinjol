<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Models\Nasabah;
use App\Models\Peminjaman;
use App\Models\User;
use App\Rules\TodayOrFutureDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $peminjamans = Peminjaman::all();
        return view('nasabah/form-peminjaman', compact('peminjamans'));
    }

    public function validatePeminjaman()
    {
        $peminjamansApprove = Peminjaman::with('nasabah')->where('status', 'approve')->get();
        $peminjamansPending = Peminjaman::with('nasabah')->where('status', 'pending')->get();


        return view('admin/validate-peminjaman', compact('peminjamansApprove', 'peminjamansPending'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('nasabah.form-peminjaman');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeminjamanRequest $request)
    {
        $nasabah = Auth::user()->nasabah;

        $jangkaWaktu = (int) $request->jangka_waktu;
        $tanggalMulai = Carbon::now();

        $jumlahPinjaman = (int) $request->jumlah_pinjaman;
        $jumlahPinjamanDiperbarui = ($jumlahPinjaman + ($jumlahPinjaman * 0.02)) / $jangkaWaktu;

        for ($i = 0; $i < $jangkaWaktu; $i++) {
            $tanggalAkhir = $tanggalMulai->copy()->addMonth()->endOfMonth()->toDateString();

            $peminjaman = new Peminjaman([
                'jumlah_pinjaman' => $jumlahPinjamanDiperbarui,
                'jangka_waktu' => $jangkaWaktu,
                'tanggal_mulai' => $tanggalMulai->toDateString(),
                'tanggal_akhir' => $tanggalAkhir,
                'alasan_peminjaman' => $request->alasan_peminjaman,
                'status' => 'pending',
                'nasabah_id' => $nasabah->id,
            ]);

            $nasabah->peminjaman()->save($peminjaman);

            $tanggalMulai->addMonth();
        }

        return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Peminjaman::findOrFail($id);
        return compact('data');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_pinjaman' => 'required|max:20',
            'jangka_waktu' => ['required', 'date'],
            'alasan_peminjaman' => 'required|max:255',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->jumlah_pinjaman = $request->jumlah_pinjaman;
        $peminjaman->jangka_waktu = $request->jangka_waktu;
        $peminjaman->alasan_peminjaman = $request->alasan_peminjaman;
        $peminjaman->tanggal_pencairan = Carbon::now();
        $peminjaman->status = 'approve';

        $peminjaman->save();
        return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

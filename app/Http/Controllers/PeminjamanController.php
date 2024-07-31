<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Models\Nasabah;
use App\Models\Peminjaman;
use App\Models\User;
use App\Rules\TodayOrFutureDate;
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
        $peminjamans = Peminjaman::with('nasabah')->get();
        return view('admin/validate-peminjaman', compact('peminjamans'));
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

        $peminjaman = new Peminjaman([
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'jangka_waktu' => $request->jangka_waktu,
            'alasan_peminjaman' => $request->alasan_peminjaman,
            'status' => 'pending',
            'nasabah_id' => $nasabah->id,
        ]);

        $nasabah->peminjaman()->save($peminjaman);

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
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin/validate-peminjaman-detail', compact('peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $peminjaman)
    {

        $request->validate([
            'jumlah_pinjaman' => 'required|max:20',
            'jangka_waktu' => ['required', 'date'],
            'alasan_peminjaman' => 'required|max:255',
        ]);

        $peminjaman = Peminjaman::where('nasabah_id', $request->nasabah_id)->update([
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'jangka_waktu' => $request->jangka_waktu,
            'alasan_peminjaman' => $request->alasan_peminjaman,
            'status' => $request->status,
        ]);

        $peminjaman->jumlah_pinjaman = $request->jumlah_pinjaman;
        $peminjaman->jangka_waktu = $request->jangka_waktu;
        $peminjaman->alasan_peminjaman = $request->alasan_peminjaman;
        $peminjaman->status = $request->status;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

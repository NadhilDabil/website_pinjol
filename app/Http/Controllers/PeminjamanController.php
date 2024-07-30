<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Peminjaman;
use App\Models\User;
use App\Rules\TodayOrFutureDate;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('nasabah/form-peminjaman', compact('peminjaman'));
    }

    public function validate_peminjaman()
    {
        $peminjaman = Peminjaman::all();
        return view('admin/validate-peminjaman', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::findOrFail($id);
        return view('nasabah.form-peminjaman')->with('user', $user->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'jumlah_pinjaman' => 'required|max:20',
            'jangka_waktu' => ['required', 'date', new TodayOrFutureDate],
            'alasan_peminjaman' => 'required|max:255',
        ]);


        $peminjaman = new Peminjaman();

        $peminjaman->jumlah_pinjaman = $request->jumlah_pinjaman;
        $peminjaman->jangka_waktu = $request->jangka_waktu;
        $peminjaman->alasan_peminjaman = $request->alasan_peminjaman;

        $peminjaman->save();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $peminjaman)
    {
        $request->validate([
            'jumlah_pinjaman' => 'required|max:20',
            'jangka_waktu' => ['required', 'date', new TodayOrFutureDate],
            'alasan_peminjaman' => 'required|max:255',
        ]);



        $peminjaman->jumlah_pinjaman = $request->jumlah_pinjaman;
        $peminjaman->jangka_waktu = $request->jangka_waktu;
        $peminjaman->alasan_peminjaman = $request->alasan_peminjaman;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

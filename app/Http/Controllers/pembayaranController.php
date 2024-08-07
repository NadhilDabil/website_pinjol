<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembayaranRequest;
use App\Models\FakturPeminjaman;
use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return view('nasabah.data-pembayaran', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePembayaranRequest $request)
    {
        dd('Hallow');
        // $pembayaran = new Pembayaran([
        //     'id_peminjaman' => $request->id_peminjaman,
        //     'jumlah_bayar' => $request->jumlah_bayar,
        //     'status_bayar' => $request->status_bayar,
        // ]);

        // if ($request->hasFile('bukti_pembayaran')) {
        //     $fileName = time() . '_' . $request->file('bukti_pembayaran')->getClientOriginalName();
        //     $filePath = $request->file('bukti_pembayaran')->storeAs('uploads_transfer/bukti_pembayaran', $fileName, 'public');

        //     // Simpan path file yang benar
        //     $pembayaran->bukti_pembayaran =  $filePath;
        // }

        // $pembayaran->status_pembayaran = '1';
        // $pembayaran->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::find($id);
        $faktur_peminjaman = FakturPeminjaman::find($id);
        return view('nasabah.data-pembayaran', compact('peminjaman', 'faktur_peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

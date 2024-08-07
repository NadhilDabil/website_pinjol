<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembayaranRequest;
use App\Models\FakturPeminjaman;
use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return view('nasabah.data-pembayaran', compact('pembayaran'));
    }

    public function validatePembayaran(){

        $pembayaranPending = Pembayaran::with('peminjaman.fakturPeminjaman.nasabah')->where('status_pembayaran', false)->get();
        $pembayaranApprove = Pembayaran::with('peminjaman.fakturPeminjaman.nasabah')->where('status_pembayaran', true)->get();

        return view('admin.validate-data-pembayaran', compact('pembayaranPending', 'pembayaranApprove'));
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
    public function store(StorePembayaranRequest $request, string $id)
    {
        $filePath = '';
        if ($request->hasFile('bukti_pembayaran')) {
            $fileName = time() . '_' . $request->file('bukti_pembayaran')->getClientOriginalName();
            $filePath = $request->file('bukti_pembayaran')->storeAs('uploads_transfer/bukti_pembayaran', $fileName, 'public');
        }

        $pembayaran = new Pembayaran([
            'peminjaman_id' => $id,
            'bukti_pembayaran' => $filePath
        ]);

        $pembayaran->save();

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::find($id);
        return view('nasabah.data-pembayaran', compact('peminjaman'));
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
        $pembayaran = Pembayaran::find($id);

        $pembayaran->status_pembayaran = true;
        $pembayaran->save();

        return redirect('validate-data-pembayaran');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

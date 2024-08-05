<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Models\FakturPeminjaman;
use App\Models\Nasabah;
use App\Models\Peminjaman;
use App\Models\User;
use App\Rules\TodayOrFutureDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $fPeminjamansApprove = FakturPeminjaman::with('nasabah')->whereNotNull('tanggal_pencairan')->get();
        $fPeminjamansPending = FakturPeminjaman::with('nasabah')->whereNull('tanggal_pencairan')->get();


        return view('admin/validate-peminjaman', compact('fPeminjamansApprove', 'fPeminjamansPending'));
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
        $jumlahAdmin = $jumlahPinjaman * 0.02;
        $jumlahPinjamanDiperbarui = ($jumlahPinjaman + $jumlahAdmin) / $jangkaWaktu;

        try {
            DB::beginTransaction();

            $fp = FakturPeminjaman::create([
                'nasabah_id' => $nasabah->id,
                'total_pinjaman' => $jumlahPinjaman,
                'biaya_admin' => $jumlahAdmin,
                'alasan_peminjaman' => $request->alasan_peminjaman,
                'jangka_waktu' => $jangkaWaktu,
            ]);

            for ($i = 0; $i < $jangkaWaktu; $i++) {
                $tanggalAkhir = $tanggalMulai->copy()->addMonth()->endOfMonth()->toDateString();

                $peminjaman = new Peminjaman([
                    'jumlah_pinjaman' => $jumlahPinjamanDiperbarui,
                    'tanggal_mulai' => $tanggalMulai->toDateString(),
                    'tanggal_akhir' => $tanggalAkhir,
                ]);

                $fp->peminjaman()->save($peminjaman);

                $tanggalMulai->addMonth();
            }

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, coba lagi.']);
        }
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

        // dd($request->all());
        $request->validate([
            'nama' => 'required|max:20',
            // 'jumlah_pinjaman' => 'required|max:20',
            'jangka_waktu' => 'required|max:255',
            'alasan_peminjaman' => 'required|max:255',
            // 'biaya_admin' => 'required|max:255',
            'total_pinjaman' => 'required|max:255',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'nama' => $request->nama,
            // 'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'jangka_waktu' => $request->jangka_waktu,
            'alasan_peminjaman' => $request->alasan_peminjaman,
        ]);

        $faktur_peminjaman = FakturPeminjaman::findOrFail($id);

        $faktur_peminjaman->update([
            'total_pinjaman' => $request->total_pinjaman,
            'biaya_admin' => $request->biaya_admin,
            'tanggal_pencairan' => Carbon::now(),
        ]);


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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNasabahFormRequest;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nasabahs = Nasabah::all();
        return view('admin/data-nasabah', compact('nasabahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('view-nasabah-page')) {
            return view('nasabah.form-data_diri');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNasabahFormRequest $request)
    {
        $file = null;
        if ($request->hasFile('foto_ktp')) {
            $fileName = time() . '_' . $request->file('foto_ktp')->getClientOriginalName();

            $file = $request->file('foto_ktp')->storeAs('uploads', $fileName, 'public');
        }


        $nasabah = new Nasabah([
            ...$request->all(),
            'tanggal_pendaftaran' => Carbon::now(),
            'usia' => intval(Carbon::now()->diffInYears($request->validated('tgl_lahir')))*-1,
            'foto_ktp' => $file,
        ]);


        $user = Auth::user();
        $user->nasabah()->save($nasabah);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nasabah $nasabah)
    {
        if (Auth::check() && Auth::user()->role === 'nasabah') {
            $nasabah->where('user_id', Auth::id())->get();
        }
        return view('nasabah.form-data_diri', compact('nasabah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nasabah $nasabah)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'nama_lengkap'  => 'required|max:255',
            'nomor_telepon'  => 'required|max:15|unique:nasabah',
            'nomor_telepon_jaminan'  => 'required|max:255',
            'tempat_tgl_lahir'  => 'required|max:50',
            'usia'  => 'required|max:3',
            'jenis_kelamin'  => 'required|in:Pria,Wanita',
            'pekerjaan'  => 'required|max:30',
            'nama_ibu'  => 'required|max:255',
            'no_rekening'  => 'required|max:15',
            'alamat'  => 'required|max:255',
            'foto_ktp'  => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nik'  => 'required|max:20|unique:nasabah',
        ]);


        if ($request->hasFile('foto_ktp')) {
            $fileName = time() . '_' . $request->file('foto_ktp')->getClientOriginalName();
            $filePath = $request->file('foto_ktp')->storeAs('uploads/foto_ktp', $fileName, 'public');

            $nasabah->foto_ktp = $filePath;
        }

        $nasabah->nama_lengkap = $request->nama_lengkap;
        $nasabah->nomor_telepon = $request->nomor_telepon;
        $nasabah->nomor_telepon_jaminan = $request->nomor_telepon_jaminan;
        $nasabah->tempat_tgl_lahir = $request->tempat_tgl_lahir;
        $nasabah->usia = $request->usia;
        $nasabah->jenis_kelamin = $request->jenis_kelamin;
        $nasabah->pekerjaan = $request->pekerjaan;
        $nasabah->nama_ibu = $request->nama_ibu;
        $nasabah->no_rekening = $request->no_rekening;
        $nasabah->alamat = $request->alamat;
        $nasabah->foto_ktp = '/storage/' . $filePath;
        $nasabah->nik = $request->nik;

        $nasabah->save();



        return redirect()->back()->with('success', 'Nasabah berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        //
    }
}

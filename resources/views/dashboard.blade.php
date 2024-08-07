@php
    $isDetail = isset($nasabah);
@endphp
@auth
    @if (!App\Models\Nasabah::where('user_id', Auth::id())->exists())
        <script>
            window.location.href = "{{ route('form-nasabah') }}";
        </script>
    @endif
@endauth

@extends('layouts')
@section('content')
    <div class="container">
        <div class="row m-2 mt-4">
            @if ($isDetail)
                @if ($nasabah->verified && $nasabah->peminjaman->count() === 0)
                    <div class="col-md-4 col-lg-4 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="card-title">Formulir Peminjaman</div>
                            </div>
                            <form action="{{ route('form-peminjaman.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="jumlah_pinjaman">Jumlah Pinjaman*</label>
                                        <input type="text" class="form-control" name="jumlah_pinjaman"
                                            placeholder="Masukkan Jumlah Pinjaman" />
                                        @error('jumlah_pinjaman')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="alasan_peminjaman">Alasan Peminjaman*</label>
                                        <input type="text" class="form-control" name="alasan_peminjaman"
                                            placeholder="Alasan Peminjaman" />
                                        @error('alasan_peminjaman')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jangka_waktu">Jangka Waktu*</label>
                                        <select id="jangka_waktu" name="jangka_waktu" class="form-control">
                                            <option value="1">1 Bulan</option>
                                            <option value="3">3 Bulan</option>
                                            <option value="6">6 Bulan</option>
                                            <option value="12">12 Bulan</option>
                                        </select>
                                        @error('jangka_waktu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-action">
                                    <input class="btn btn-primary" type="submit" value="Kirim">
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                <div class="col-md-12 col-lg-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">

                            @if ($peminjaman)
                                <div class="card-title">Pembayaran</div>
                                <div class="card-body m-2">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <p>
                                                Pembayaran sudah bisa dilakukan. Silakan bayar sebelum tanggal terakhir.
                                                <a href="#">Klik di sini untuk melihat bukti transaksi</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body m-2">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div>
                                                <h6 class="fw-bold">Tenggat Tanggal Pembayaran</h6>
                                                <p class="fw-light">{{ $peminjaman->tanggal_akhir }}</p>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold">Nominal Pembayaran</h6>
                                                <p class="fw-light">Rp.
                                                    {{ number_format($peminjaman->jumlah_pinjaman, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-action d-flex flex-row-reverse">
                                    <a type="submit" class="btn btn-primary"
                                        href="{{ route('pembayaran.show', $peminjaman->id) }}">Kirim Bukti Pembayaran</a>

                                </div>
                            @else
                                <div class="card-title">Proses</div>

                                <div class="card-body m-2">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <p>
                                                Permintaan Anda Sedang Kami Proses
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif


            @if ($isDetail)
                <div class="{{ $nasabah->verified && $nasabah->peminjaman->count() === 0 ? 'col-md-8 col-lg-8' : 'col-md-12 col-lg-12' }} d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="card-title">Data Peminjam</div>
                        </div>
                        <div class="card-body m-2">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div>
                                        <h6 class="fw-bold">Nomor Induk Kependudukan (NIK)</h6>
                                        <p class="fw-light">{{ $nasabah->nik }}</p>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold">Nama Lengkap</h6>
                                        <p class="fw-light">{{ Str::upper($nasabah->nama_lengkap) }}</p>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold">Nomor Telepon</h6>
                                        <p class="fw-light">+62 {{ $nasabah->nomor_telepon }}</p>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold">Alamat</h6>
                                        <p class="fw-light">{{ Str::upper($nasabah->alamat) }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div>
                                        <h6 class="fw-bold">Pekerjaan</h6>
                                        <p class="fw-light">{{ Str::upper($nasabah->pekerjaan) }}</p>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold">Jenis Kelamin</h6>
                                        <p class="fw-light">{{ Str::upper($nasabah->jenis_kelamin) }}</p>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold">Status</h6>
                                        <div>
                                            <p class="fw-light">
                                                <span
                                                    class="badge text-bg-{{ $nasabah->verified ? 'success' : 'warning' }}">
                                                    {{ $nasabah->verified ? 'Terverifikasi' : 'Proses verifikasi' }}
                                                </span>
                                            </p>
                                            <p class="mb-0 fw-light" style="font-size: 0.8rem; margin-top: -1rem">
                                                *Peminjaman dapat dilakukan saat data sudah diverifikasi.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endsection

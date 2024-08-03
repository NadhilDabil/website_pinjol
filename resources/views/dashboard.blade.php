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
            @if ($nasabah->verified)
                <div class="col-md-4 col-lg-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="card-title">Formulir Peminjaman</div>
                        </div>
                        <form action="{{ route('form-peminjaman.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                                    <input type="text" class="form-control" name="jumlah_pinjaman"
                                        placeholder="Masukkan Jumlah Pinjaman" />
                                    @error('jumlah_pinjaman')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alasan_peminjaman">Alasan Peminjaman</label>
                                    <input type="text" class="form-control" name="alasan_peminjaman"
                                        placeholder="Alasan Peminjaman" />
                                    @error('alasan_peminjaman')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jangka_waktu">Jangka Waktu</label>
                                    <input type="date" class="form-control" name="jangka_waktu" />
                                    @error('jangka_waktu')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <input class="btn btn-primary" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="{{ $nasabah->verified ? 'col-md-8 col-lg-8' : 'col-md-12 col-lg-12' }} d-flex">
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
                                            <span class="badge text-bg-{{ $nasabah->verified ? 'success' : 'warning' }}">
                                                {{ $nasabah->verified ? 'Active' : 'Proses verifikasi' }}
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
        </div>
    @endsection

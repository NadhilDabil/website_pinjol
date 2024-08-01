@php
    $isDetail = isset($nasabah);
@endphp
@extends('layouts')
@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ $isDetail ? 'Detail' : 'Formulir Data Diri'}}</div>
                    </div>
                    <form action="{{ route('form-nasabah.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="name" class="form-control" name="nama_lengkap"
                                            placeholder="Masukkan Nama Lengkap"
                                            value="{{ $isDetail ? $nasabah->nama_lengkap : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                    </div>

                                    <div class="form-group">
                                        <label for="nomor_telepon">No Telepon</label>
                                        <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                            placeholder="Masukkan Nomor Telepon"
                                            value="{{ $isDetail ? $nasabah->nomor_telepon : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                    </div>

                                    <div class="form-group">
                                        <label for="nomor_telepon_jaminan">No Telepon Jaminan</label>
                                        <input type="tel" class="form-control" id="nomor_telepon_jaminan"
                                            name="nomor_telepon_jaminan" placeholder="Masukkan Nomor Telepon Jaminan"
                                            value="{{ $isDetail ? $nasabah->nomor_telepon_jaminan : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat lahiran</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Masukkan Tempat Lahir"
                                            value="{{ $isDetail ? $nasabah->tempat_lahir : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                            placeholder="Tanggal Lahir" value="{{ $isDetail ? $nasabah->tgl_lahir : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                    </div>

                                    {{-- <div class="form-group">
                                        <label for="usia">Usia</label>
                                        <input type="text" class="form-control" id="usia" name="usia"
                                            placeholder="Masukkan Usia Anda" />
                                    </div> --}}

                                    <div class="form-group">
                                        <label>Gender</label><br />
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    id="jenis_kelamin_pria" value="Pria"
                                                    {{ $isDetail ? ($nasabah->jenis_kelamin == 'Pria' ? 'checked' : '') : '' }}
                                                    {{ $isDetail ? 'disabled' : '' }} />
                                                <label class="form-check-label" for="jenis_kelamin_pria">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    id="jenis_kelamin_wanita" value="Wanita"
                                                    {{ $isDetail ? ($nasabah->jenis_kelamin == 'Wanita' ? 'checked' : '') : '' }}
                                                    {{ $isDetail ? 'disabled' : '' }} />
                                                <label class="form-check-label" for="jenis_kelamin_wanita">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">

                                    <div class="form-group">
                                        <label for="pekerjaaan">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Masukkan Pekerjaan"
                                            value="{{ $isDetail ? $nasabah->pekerjaan : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_ibu">Nama Orangtua</label>
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                            placeholder="Masukkan Nama Orangtua"
                                            value="{{ $isDetail ? $nasabah->nama_ibu : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                    </div>

                                    @if (!$isDetail)
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                <input type="text" class="form-control" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="email"
                                                    value="{{ Auth::user()->email }}" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_rekening">Nomor Rekening</label>
                                            <input type="name" class="form-control" name="no_rekening"
                                                placeholder="Masukkan Nomor Rekening" />
                                        </div>
                                    @endif

                                    {{-- <div class="form-group">
                                    <label for="nama">Nomor Rekening</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            aria-label="Text input with dropdown button" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-border dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Dropdown
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div role="separator" class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}


                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Masukkan Alamat"
                                            value="{{ $isDetail ? $nasabah->alamat : '' }}"
                                            {{ $isDetail ? 'readonly' : '' }}/>
                                    </div>

                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                               placeholder="Masukkan NIK"
                                               value="{{ $isDetail ? $nasabah->nik : '' }}"
                                               {{ $isDetail ? 'readonly' : '' }}/>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="foto_ktp">Foto KTP Anda</label><br />
                                        @if($isDetail && $nasabah->foto_ktp)
                                            <a href="{{ $nasabah->foto_ktp_url }}" target="_blank" class="btn btn-primary">
                                                Download KTP
                                            </a>
                                            <br />
                                            <img src="{{ $nasabah->foto_ktp_url }}" alt="Foto KTP" style="max-width: 100%; height: auto; margin-top: 10px;" />
                                        @else
                                            <input type="file" class="form-control-file" name="foto_ktp" id="foto_ktp" accept="image/png, image/jpeg" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            @if ($isDetail)
                                <a class="btn btn-secondary" href="{{ route('data-nasabah') }}">Close</a>
                            @else
                                <button class="btn btn-success" type="submit">Submit</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

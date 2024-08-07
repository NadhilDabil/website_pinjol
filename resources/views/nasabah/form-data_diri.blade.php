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
                        <div class="card-title">{{ $isDetail ? 'Detail' : 'Formulir Data Diri' }}</div>
                    </div>
                    <form action="{{ route('form-nasabah.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="nik">NIK*</label>
                                        <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK"
                                            value="{{ $isDetail ? $nasabah->nik : '' }}{{ old('nik') }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                        @error('nik')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap*</label>
                                        <input type="name" class="form-control" name="nama_lengkap"
                                            placeholder="Masukkan Nama Lengkap"
                                            value="{{ $isDetail ? $nasabah->nama_lengkap : '' }}{{ old('nama_lengkap') }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                        @error('nama_lengkap')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nomor_telepon">No Telepon*</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+62</span>
                                            <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                                placeholder="896xxxxx"
                                                value="{{ $isDetail ? $nasabah->nomor_telepon : '' }}{{ old('nomor_telepon') }}"
                                                {{ $isDetail ? 'readonly' : '' }} />
                                        </div>
                                        @error('nomor_telepon')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nomor_telepon_jaminan">No Telepon Jaminan*</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+62</span>
                                            <input type="tel" class="form-control" id="nomor_telepon_jaminan"
                                                name="nomor_telepon_jaminan" placeholder="896xxxxx"
                                                value="{{ $isDetail ? $nasabah->nomor_telepon_jaminan : '' }}{{ old('nomor_telepon_jaminan') }}"
                                                {{ $isDetail ? 'readonly' : '' }} />
                                        </div>
                                        @error('nomor_telepon_jaminan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat lahiran*</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Masukkan Tempat Lahir"
                                            value="{{ $isDetail ? $nasabah->tempat_lahir : '' }}{{ old('tempat_lahir') }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                        @error('tempat_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir*</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                            placeholder="Tanggal Lahir" value="{{ $isDetail ? $nasabah->tgl_lahir : '' }}{{ old('tgl_lahir') }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                        @error('tgl_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="pekerjaaan">Pekerjaan*</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Masukkan Pekerjaan"
                                            value="{{ $isDetail ? $nasabah->pekerjaan : '' }}{{ old('pekerjaan') }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                        @error('pekerjaan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_ibu">Nama Orangtua*</label>
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                            placeholder="Masukkan Nama Orangtua"
                                            value="{{ $isDetail ? $nasabah->nama_ibu : '' }}{{ old('nama_ibu') }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                        @error('nama_ibu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if (!$isDetail)
                                        <div class="form-group">
                                            <label for="email">Email Address*</label>
                                            <div class="input-group">
                                                <span class="input-group-text">@</span>
                                                <input type="text" class="form-control" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="email"
                                                    value="{{ Auth::user()->email }}" readonly />
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nomor Rekening*</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text"
                                                    aria-label="Text input with dropdown button" name="no_rekening" value="{{ old('no_rekening') }}" />
                                                <select name="jenis_bank" class="form-select">
                                                    <option value="BCA" {{ old('jenis_bank') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                                    <option value="BNI" {{ old('jenis_bank') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                                    <option value="BRI" {{ old('jenis_bank') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                                    <option value="Mandiri" {{ old('jenis_bank') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                                    <option value="CIMB Niaga" {{ old('jenis_bank') ==  'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                                                    <option value="BTPN" {{ old('jenis_bank') == 'BTPN' ? 'selected' : '' }}>BTPN</option>
                                                    <option value="JAGO" {{ old('jenis_bank') == 'JAGO' ? 'selected' : '' }}>Jago</option>
                                                    <option value="Danamon" {{ old('jenis_bank') == 'Danamon' ? 'selected' : '' }}>Danamon</option>
                                                    <option value="BTN" {{ old('jenis_bank') == 'BTN' ? 'selected' : '' }}>BTN</option>
                                                </select>
                                            </div>
                                            @error('no_rekening')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="alamat">Alamat*</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Masukkan Alamat" value="{{ $isDetail ? $nasabah->alamat : '' }}{{ old('alamat') }}"
                                            {{ $isDetail ? 'readonly' : '' }} />
                                        @error('alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Gender*</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    id="jenis_kelamin_pria" value="Pria"
                                                    {{ $isDetail ? ($nasabah->jenis_kelamin == 'Pria' ? 'checked' : '') : '' }}
                                                    {{ $isDetail ? 'disabled' : '' }} {{ old('jenis_kelamin') == 'Pria' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="jenis_kelamin_pria">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    id="jenis_kelamin_wanita" value="Wanita"
                                                    {{ $isDetail ? ($nasabah->jenis_kelamin == 'Wanita' ? 'checked' : '') : '' }}
                                                    {{ $isDetail ? 'disabled' : '' }} {{ old('jenis_kelamin') == 'Wanita' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="jenis_kelamin_wanita">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="foto_ktp">Foto KTP Anda*</label>
                                        @if ($isDetail && $nasabah->foto_ktp)
                                            <a href="{{ $nasabah->foto_ktp_url }}" target="_blank"
                                                class="btn btn-primary">
                                                Download KTP
                                            </a>
                                            <br />
                                            <img src="{{ $nasabah->foto_ktp_url }}" alt="Foto KTP"
                                                style="max-width: 100%; height: auto; margin-top: 10px;" />
                                        @else
                                            <input type="file" class="form-control-file" name="foto_ktp"
                                                id="foto_ktp" accept="image/png, image/jpeg"/>
                                            <br />
                                            <img id="foto_ktp_preview" src="#" alt="Preview"
                                                style="max-width: 100%; height: auto; margin-top: 10px; display: none;" />
                                        @endif
                                        @error('foto_ktp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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

    <script>
        document.getElementById('foto_ktp').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('foto_ktp_preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection

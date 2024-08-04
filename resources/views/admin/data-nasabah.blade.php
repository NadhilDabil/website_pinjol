@use('\Illuminate\Support\FacadesAuth')
@extends('layouts')

@section('content')
    <div class="container">
        <div class="page-inner">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs nav-justified mb-5" style="padding-right: 20rem; padding-left: 20rem;" id="myTab"
                role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-1" data-bs-toggle="tab" href="#content-1" role="tab"
                        aria-controls="content-1" aria-selected="true">Nasabah</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-2" data-bs-toggle="tab" href="#content-2" role="tab"
                        aria-controls="content-2" aria-selected="false">Verifikasi Nasabah
                        <span class="badge rounded-pill text-bg-primary">{{ $totalNeedVerifiedNasabah }}</span>
                    </a>
                </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="content-1" role="tabpanel" aria-labelledby="tab-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive" style="height: 33rem;">
                                        <table id="basic-datatables" class="display table table-striped table-hover"
                                            style="">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col" class="text">Nama Nasabah</th>
                                                    <th scope="col" class="text">NIK</th>
                                                    <th scope="col" class="text">No Telephone</th>
                                                    <th scope="col" class="text">Jenis Kelamin</th>
                                                    <th scope="col" class="text">Action</th>
                                                </tr>
                                            </thead>

                                            @foreach ($nasabahs as $index => $nasabah)
                                                <tbody>
                                                    <tr>
                                                        <td class="text">{{ $index + 1 }}</td>
                                                        <td class="text">{{ $nasabah->nama_lengkap }}</td>
                                                        <td class="text">{{ $nasabah->nik }}</td>
                                                        <td class="text">{{ $nasabah->nomor_telepon }}</td>
                                                        <td class="text">{{ $nasabah->jenis_kelamin }}</td>
                                                        <td class="text"><a class="btn btn-info"
                                                                href="{{ route('form-nasabah.detail', $nasabah->id) }}">Info</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="content-2" role="tabpanel" aria-labelledby="tab-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive" style="height: 33rem">
                                        <table id="basic-datatables" class="display table table-striped table-hover"
                                            style="">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col" class="text">Nama Nasabah</th>
                                                    <th scope="col" class="text">NIK</th>
                                                    <th scope="col" class="text">No Telephone</th>
                                                    <th scope="col" class="text">Jenis Kelamin</th>
                                                    <th scope="col" class="text">Status</th>
                                                    <th scope="col" class="text text-center">Action</th>
                                                </tr>
                                            </thead>

                                            @foreach ($nasabahs->where('verified', false) as $index => $nasabah)
                                                <tbody>
                                                    <tr>
                                                        <td class="text">{{ $index + 1 }}</td>
                                                        <td class="text">{{ $nasabah->nama_lengkap }}</td>
                                                        <td class="text">{{ $nasabah->nik }}</td>
                                                        <td class="text">{{ $nasabah->nomor_telepon }}</td>
                                                        <td class="text">{{ $nasabah->jenis_kelamin }}</td>
                                                        <td class="text">
                                                            <p class="fw-light">
                                                                <span
                                                                    class="badge text-bg-{{ $nasabah->verified ? 'success' : 'warning' }}">
                                                                    {{ $nasabah->verified ? 'Terverifikasi' : 'Menunggu verifikasi' }}
                                                                </span>
                                                            </p>
                                                        </td>
                                                        <td class="text">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editholiday{{ $nasabah->id }}"><i
                                                                    class="icofont-edit text-success"></i>Verifikasi</button>
                                                            <a class="btn btn-info"
                                                                href="{{ route('form-nasabah.detail', $nasabah->id) }}">Info</a>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                                <div class="modal modal-xl fade" id="editholiday{{ $nasabah->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title  fw-bold" id="editholidayLabel">
                                                                    Verifikasi data nasabah
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row m-3">
                                                                    <div class="col-md-4 col-lg-4">
                                                                        <div>
                                                                            <h6 class="fw-bold">Nomor Induk
                                                                                Kependudukan (NIK)</h6>
                                                                            <p class="fw-light">{{ $nasabah->nik }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="fw-bold">Nama Lengkap</h6>
                                                                            <p class="fw-light">
                                                                                {{ Str::upper($nasabah->nama_lengkap) }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="fw-bold">Jenis Kelamin</h6>
                                                                            <p class="fw-light">
                                                                                {{ Str::upper($nasabah->jenis_kelamin) }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="fw-bold">Alamat</h6>
                                                                            <p class="fw-light">
                                                                                {{ Str::upper($nasabah->alamat) }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 col-lg-4">
                                                                        <div>
                                                                            <h6 class="fw-bold">Pekerjaan</h6>
                                                                            <p class="fw-light">
                                                                                {{ Str::upper($nasabah->pekerjaan) }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="fw-bold">Nomor Telepon</h6>
                                                                            <p class="fw-light">+62
                                                                                {{ $nasabah->nomor_telepon }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="fw-bold">Nomor Telepon Jaminan</h6>
                                                                            <p class="fw-light">+62
                                                                                {{ $nasabah->nomor_telepon_jaminan }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="fw-bold">Nama Ibu Kandung</h6>
                                                                            <p class="fw-light">
                                                                                {{ Str::upper($nasabah->nama_ibu) }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="foto_ktp">Foto KTP</label>
                                                                            <br />
                                                                            <img src="{{ $nasabah->foto_ktp_url }}"
                                                                                alt="Foto KTP"
                                                                                style="max-width: 100%; height: auto; margin-top: 10px;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-action">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a class="btn btn-success" type="submit" href="{{ route('data-nasabah.verified', $nasabah->id) }}">Setujui</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabs content -->
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

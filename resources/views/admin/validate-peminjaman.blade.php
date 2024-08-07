@use('\Illuminate\Support\Facades\Auth')
@extends('layouts')

@section('title')
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <h2>
                {{-- {{$title}} --}}
            </h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Peminjaman Pending</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" class="text">Nama Nasabah</th>
                                            <th scope="col" class="text">NIK</th>
                                            <th scope="col" class="text">Peminjaman</th>
                                            <th scope="col" class="text">Status</th>
                                            <th scope="col" class="text">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fPeminjamansPending as $index => $fakturPeminjaman)
                                            <tr>
                                                <td class="text">{{ $index + 1 }}</td>
                                                <td class="text">{{ $fakturPeminjaman->nasabah->nama_lengkap }}</td>
                                                <td class="text">{{ $fakturPeminjaman->nasabah->nik }}</td>
                                                <td class="text">{{ $fakturPeminjaman->total_pinjaman }}</td>
                                                <td class="text">
                                                    <span
                                                        class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}
                                                    </span>
                                                </td>
                                                <td class="text"><button type="button" class="btn btn-outline-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editholiday{{ $fakturPeminjaman->id }}"><i
                                                            class="icofont-edit text-success"></i>Verifikasi</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($fPeminjamansPending as $index => $fakturPeminjaman)
                <div class="modal modal-xl fade" id="editholiday{{ $fakturPeminjaman->id }}" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="editholidayLabel">Verifikasi
                                    <span
                                        class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">
                                        {{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}
                                    </span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('validate-peminjaman.update', $fakturPeminjaman->id) }}"
                                    enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="nama">Nama Nasabah</label>
                                        <input type="text" id="nama" class="form-control" name="nama"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ $fakturPeminjaman->nasabah->nama_lengkap }}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="total_pinjaman">Jumlah Pinjaman</label>
                                        <input type="text" id="total_pinjaman" class="form-control" name="total_pinjaman"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ $fakturPeminjaman->total_pinjaman }}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_admin">Biaya Admin</label>
                                        <input type="text" id="biaya_admin" class="form-control" name="biaya_admin"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ $fakturPeminjaman->biaya_admin }}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="alasan_peminjaman">Alasan Peminjaman</label>
                                        <input type="text" class="form-control" name="alasan_peminjaman"
                                            placeholder="Alasan Peminjaman"
                                            value="{{ $fakturPeminjaman->alasan_peminjaman }}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="bukti_transfer">Bukti Transfer</label>
                                        <input type="file" class="form-control" name="bukti_transfer" id="bukti_transfer">
                                        <img id="bukti_transfer_preview" src="#" alt="Preview"
                                            style="max-width: 30%; height: auto; margin-top: 10px; display: none;" />
                                    </div>

                                    <h4 class="fw-bold mt-5 mb-2">Peminjaman Detail</h4>
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Jumlah Pinjaman</th>
                                                <th scope="col">Tanggal Mulai</th>
                                                <th scope="col">Tanggal Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fakturPeminjaman->peminjaman as $item)
                                                <tr>
                                                    <td class="text">{{ $loop->iteration }}</td>
                                                    <td class="text">{{ $item->jumlah_pinjaman }}</td>
                                                    <td class="text">
                                                        <input class="form-control" name="tanggal_mulai[]"
                                                            value="{{ $item->tanggal_mulai }}" type="date" />
                                                    </td>
                                                    <td class="text">
                                                        <input class="form-control" name="tanggal_akhir[]"
                                                            value="{{ $item->tanggal_akhir }}" type="date" />
                                                    </td>
                                                    <!-- Hidden input to store the ID -->
                                                    <input type="hidden" name="peminjaman_id[]"
                                                        value="{{ $item->id }}" />
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Setujui</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Peminjaman Approve</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" class="text">Nama Nasabah</th>
                                            <th scope="col" class="text">NIK</th>
                                            <th scope="col" class="text">Peminjaman</th>
                                            <th scope="col" class="text">Biaya Admin</th>
                                            <th scope="col" class="text">Status</th>
                                            <th scope="col" class="text">Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($fPeminjamansApprove as $index => $fakturPeminjaman)
                                        <tbody>
                                            <tr>
                                                <td class="text">{{ $index + 1 }}</td>
                                                <td class="text">{{ $fakturPeminjaman->nasabah->nama_lengkap }}</td>
                                                <td class="text">{{ $fakturPeminjaman->nasabah->nik }}</td>
                                                <td class="text">{{ $fakturPeminjaman->total_pinjaman }}</td>
                                                <td class="text">{{ $fakturPeminjaman->biaya_admin }}</td>
                                                <td class="text"><span
                                                        class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}</span>
                                                </td>
                                                <td class="text"><button type="button"
                                                        class="btn btn-outline-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#editholiday{{ $fakturPeminjaman->id }}"><i
                                                            class="icofont-edit text-success"></i>Informasi</button></td>
                                                {{-- <td class="text"><a class="btn btn-info" href="{{ route('validate-peminjaman.edit', $peminjaman->id) }}">Info</a></td> --}}

                                            </tr>
                                        </tbody>


                                        <div class="modal fade" id="editholiday{{ $fakturPeminjaman->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title  fw-bold" id="editholidayLabel">Informasi
                                                            <span
                                                                class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}</span>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('validate-peminjaman.update', $fakturPeminjaman->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')


                                                            <div class="form-group">
                                                                <label for="nama">Nama Nasabah</label>
                                                                <input type="text" id="nama" class="form-control"
                                                                    name="nama" placeholder="Masukkan Jumlah Pinjaman"
                                                                    value="{{ $fakturPeminjaman->nasabah->nama_lengkap }}"
                                                                    readonly />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="total_pinjaman">Jumlah Pinjaman</label>
                                                                <input type="text" id="total_pinjaman"
                                                                    class="form-control" name="total_pinjaman"
                                                                    placeholder="Masukkan Jumlah Pinjaman"
                                                                    value="{{ $fakturPeminjaman->total_pinjaman }}"
                                                                    readonly />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="alasan_peminjaman">Alasan Peminjaman</label>
                                                                <input type="text" class="form-control"
                                                                    name="alasan_peminjaman"
                                                                    placeholder="Alasan Peminjaman"
                                                                    value="{{ $fakturPeminjaman->alasan_peminjaman }}"
                                                                    readonly />

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="jangka_waktu">Jangka Waktu</label>
                                                                <input type="date" class="form-control"
                                                                    name="jangka_waktu"
                                                                    value="{{ $fakturPeminjaman->jangka_waktu }}"
                                                                    readonly />
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close">Close</button>
                                                            </div>
                                                        </form>
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


    <script>
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>

    <script>
        document.getElementById('bukti_transfer').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('bukti_transfer_preview');

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


    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endsection

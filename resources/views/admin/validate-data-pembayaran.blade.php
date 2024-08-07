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
                            <h4 class="card-title">Verifikasi Pembayaran Pending</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" class="text">Nama Nasabah</th>
                                            <th scope="col" class="text">Tanggal Akhir</th>
                                            <th scope="col" class="text">Status</th>
                                            <th scope="col" class="text">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembayaranPending as $items)
                                            <tr>
                                                <td class="text">{{ $loop->iteration }}</td>
                                                <td class="text">
                                                    {{ $items->peminjaman->fakturPeminjaman->nasabah->nama_lengkap }}</td>
                                                <td class="text">
                                                    {{ \Carbon\Carbon::parse($items->peminjaman->tanggal_akhir)->format('d M Y') }}
                                                </td>
                                                <td class="text">
                                                    <span
                                                        class="badge {{ $items->status_pembayaran ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $items->status_pembayaran ? 'Berhasil' : 'Menunggu' }}
                                                    </span>
                                                </td>
                                                <td class="text"><button type="button" class="btn btn-outline-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editholiday{{ $items->id }}"><i
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

            @foreach ($pembayaranPending as $items)
                <div class="modal modal-xl fade" id="editholiday{{ $items->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="editholidayLabel">Verifikasi Pembayaran
                                    <span
                                        class="badge {{ $items->status_pembayaran ? 'text-bg-success' : 'text-bg-warning' }} fs-6">
                                        {{ $items->status_pembayaran ? 'Berhasil' : 'Menunggu' }}
                                    </span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('validate-data-pembayaran.update', $items->id) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="nama">Nama Nasabah</label>
                                        <input type="text" id="nama" class="form-control" name="nama"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ $items->peminjaman->fakturPeminjaman->nasabah->nama_lengkap }}"
                                            readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                        <input type="text" id="tanggal_akhir" class="form-control" name="tanggal_akhir"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ \Carbon\Carbon::parse($items->peminjaman->tanggal_akhir)->format('d M Y') }}"
                                            readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_admin">Biaya Admin</label>
                                        <input type="text" id="biaya_admin" class="form-control" name="biaya_admin"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ $items->peminjaman->fakturPeminjaman->biaya_admin }}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="alasan_peminjaman">Nominal Pembayaran</label>
                                        <input type="text" class="form-control" name="alasan_peminjaman"
                                            placeholder="Alasan Peminjaman"
                                            value="{{ $items->peminjaman->jumlah_pinjaman }}" readonly />
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                            <br />
                                            <img src="{{ $items->bukti_pembayaran_url }}" alt="Bukti Pembayaran"
                                                style="max-width: 100%; height: auto; margin-top: 10px;" />
                                        </div>
                                    </div>


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
                            <h4 class="card-title">Verifikasi Pembayaran Approve</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" class="text">Nama Nasabah</th>
                                            <th scope="col" class="text">Tanggal Akhir</th>
                                            <th scope="col" class="text">Status</th>
                                            <th scope="col" class="text">Action</th>
                                        </tr>
                                    </thead>

                                    @foreach ($pembayaranApprove as $items)
                                        <tr>
                                            <td class="text">{{ $loop->iteration }}</td>
                                            <td class="text">
                                                {{ $items->peminjaman->fakturPeminjaman->nasabah->nama_lengkap }}</td>
                                            <td class="text">
                                                {{ \Carbon\Carbon::parse($items->peminjaman->tanggal_akhir)->format('d M Y') }}
                                            </td>
                                            <td class="text">
                                                <span
                                                    class="badge {{ $items->status_pembayaran ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $items->status_pembayaran ? 'Berhasil' : 'Menunggu' }}
                                                </span>
                                            </td>
                                            <td class="text"><button type="button" class="btn btn-outline-secondary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editholiday{{ $items->id }}"><i
                                                        class="icofont-edit text-success"></i>Informasi</button></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @foreach ($pembayaranApprove as $items)
                <div class="modal modal-xl fade" id="editholiday{{ $items->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title  fw-bold" id="editholidayLabel">Informasi Approve
                                    <span
                                        class="badge {{ $items->status_pembayaran ? 'text-bg-success' : 'text-bg-warning' }} fs-6">
                                        {{ $items->status_pembayaran ? 'Berhasil' : 'Menunggu' }}
                                    </span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">

                                    @method('PUT')


                                    <div class="form-group">
                                        <label for="nama">Nama Nasabah</label>
                                        <input type="text" id="nama" class="form-control" name="nama"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ $items->peminjaman->fakturPeminjaman->nasabah->nama_lengkap }}"
                                            readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                        <input type="text" id="tanggal_akhir" class="form-control"
                                            name="tanggal_akhir" placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ \Carbon\Carbon::parse($items->peminjaman->tanggal_akhir)->format('d M Y') }}"
                                            readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_admin">Biaya Admin</label>
                                        <input type="text" id="biaya_admin" class="form-control" name="biaya_admin"
                                            placeholder="Masukkan Jumlah Pinjaman"
                                            value="{{ $items->peminjaman->fakturPeminjaman->biaya_admin }}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label for="alasan_peminjaman">Nominal Pembayaran</label>
                                        <input type="text" class="form-control" name="alasan_peminjaman"
                                            placeholder="Alasan Peminjaman"
                                            value="{{ $items->peminjaman->jumlah_pinjaman }}" readonly />
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                            <br />
                                            <img src="{{ $items->bukti_pembayaran_url }}" alt="Bukti Pembayaran"
                                                style="max-width: 100%; height: auto; margin-top: 10px;" />
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            @endforeach
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

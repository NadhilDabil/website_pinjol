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
                                            <th scope="col" class="text">Biaya Admin</th>
                                            <th scope="col" class="text">Status</th>
                                            <th scope="col" class="text">Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($fPeminjamansPending as $index => $fakturPeminjaman)

                                        <tbody>
                                            <tr>
                                                <td class="text">{{ $index + 1 }}</td>
                                                <td class="text">{{ $fakturPeminjaman->nasabah->nama_lengkap }}</td>
                                                <td class="text">{{ $fakturPeminjaman->nasabah->nik }}</td>
                                                <td class="text">{{ $fakturPeminjaman->total_pinjaman }}</td>
                                                <td class="text">{{ $fakturPeminjaman->biaya_admin }}</td>
                                                <td class="text"><span class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}</span></td>
                                                <td class="text"><button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editholiday{{$fakturPeminjaman->id}}"><i class="icofont-edit text-success"></i>Verifikasi</button></td>
                                                {{-- <td class="text"><a class="btn btn-info" href="{{ route('validate-peminjaman.edit', $peminjaman->id) }}">Info</a></td> --}}

                                            </tr>
                                        </tbody>


                                        <div class="modal fade" id="editholiday{{$fakturPeminjaman->id}}" tabindex="-1" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title  fw-bold" id="editholidayLabel">Verifikasi
                                                            <span class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}</span>
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
                                                                    <input type="text" id="nama"
                                                                        class="form-control" name="nama"
                                                                        placeholder="Masukkan Jumlah Pinjaman" value="{{$fakturPeminjaman->nasabah->nama_lengkap}}"  readonly />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="total_pinjaman">Jumlah Pinjaman</label>
                                                                    <input type="text" id="total_pinjaman"
                                                                        class="form-control" name="total_pinjaman"
                                                                        placeholder="Masukkan Jumlah Pinjaman" value="{{$fakturPeminjaman->total_pinjaman}}" readonly />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="biaya_admin">Biaya Admin</label>
                                                                    <input type="text" id="biaya_admin"
                                                                        class="form-control" name="biaya_admin"
                                                                        placeholder="Masukkan Jumlah Pinjaman" value="{{$fakturPeminjaman->biaya_admin}}" readonly />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="alasan_peminjaman">Alasan Peminjaman</label>
                                                                    <input type="text" class="form-control"
                                                                        name="alasan_peminjaman"
                                                                        placeholder="Alasan Peminjaman" value="{{$fakturPeminjaman->alasan_peminjaman}}" readonly />

                                                                </div>

                                                                <div class="form-footer">
                                                                    <label for="">Tanggal Mulai</label>
                                                                    <input type="text" class="form-control" name="tanggal_mulai" id="" value="" readonly>

                                                                    <label for="">Tanggal Mulai</label>
                                                                    <input type="text" class="form-control" name="tanggal_mulai" id="" value="" readonly>
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


                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

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
                                                <td class="text"><span class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}</span></td>
                                                <td class="text"><button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editholiday{{$fakturPeminjaman->id}}"><i class="icofont-edit text-success"></i>Informasi</button></td>
                                                {{-- <td class="text"><a class="btn btn-info" href="{{ route('validate-peminjaman.edit', $peminjaman->id) }}">Info</a></td> --}}

                                            </tr>
                                        </tbody>


                                        <div class="modal fade" id="editholiday{{$fakturPeminjaman->id}}" tabindex="-1" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title  fw-bold" id="editholidayLabel">Informasi
                                                            <span class="badge {{ $fakturPeminjaman->tanggal_pencairan ? 'text-bg-success' : 'text-bg-warning' }} fs-6">{{ $fakturPeminjaman->tanggal_pencairan ? 'Berhasil' : 'Menunggu' }}</span>
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
                                                                    <input type="text" id="nama"
                                                                        class="form-control" name="nama"
                                                                        placeholder="Masukkan Jumlah Pinjaman" value="{{$fakturPeminjaman->nasabah->nama_lengkap}}"  readonly />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="total_pinjaman">Jumlah Pinjaman</label>
                                                                    <input type="text" id="total_pinjaman"
                                                                        class="form-control" name="total_pinjaman"
                                                                        placeholder="Masukkan Jumlah Pinjaman" value="{{$fakturPeminjaman->total_pinjaman}}" readonly />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="alasan_peminjaman">Alasan Peminjaman</label>
                                                                    <input type="text" class="form-control"
                                                                        name="alasan_peminjaman"
                                                                        placeholder="Alasan Peminjaman" value="{{$fakturPeminjaman->alasan_peminjaman}}" readonly />

                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="jangka_waktu">Jangka Waktu</label>
                                                                    <input type="date" class="form-control"
                                                                        name="jangka_waktu"  value="{{$fakturPeminjaman->jangka_waktu}}" readonly />
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
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endsection

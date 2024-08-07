@use('\Illuminate\Support\FacadesAuth')
@extends('layouts')

@section('content')


    <div class="container">
        <div class="page-inner">
            <h2>
                {{-- {{$title}} --}}
            </h2>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">Pembayaran</h4>
                            </div>
                            <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body m-2">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div>
                                                <h6 class="fw-bold">Tanggal Peminjaman Dimulai</h6>
                                                <p class="fw-light">{{$peminjaman->tanggal_mulai}}</p>
                                            </div>

                                            <div>
                                                <h6 class="fw-bold">Nominal Pembayaran</h6>
                                                <p class="fw-light">Rp. {{ number_format($peminjaman->jumlah_pinjaman, 0, ',', '.') }}</p>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold">Biaya Admin</h6>
                                                <p class="fw-light">{{ $faktur_peminjaman->biaya_admin }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div>
                                                <h6 class="fw-bold">Tenggat Tanggal Pembayaran</h6>
                                                <p class="fw-light">{{$peminjaman->tanggal_akhir}}</p>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold">Alasan Meminjam</h6>
                                                <p class="fw-light">{{ $faktur_peminjaman->alasan_peminjaman}}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div>
                                                <h6 class="fw-bold">Bukti Pembayaran</h6>
                                                <input type="file" class="form-control" name="bukti_pembayaran"
                                                    id="bukti_pembayaran">
                                                <img id="bukti_pembayaran_preview" src="#" alt="Preview"
                                                    style="max-width: 50%; height: auto; margin-top: 10px; display: none;" />
                                            </div>
                                        </div>

                                        <div class="card-action d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $("#basic-datatables").DataTable({});

            });
        </script>

        <script>
            document.getElementById('bukti_pembayaran').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('bukti_pembayaran_preview');

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

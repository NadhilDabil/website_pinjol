@extends('layouts')

@section('content')
<div class="container">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Formulir Data Diri</div>
                </div>
                <form action="{{}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                                    <input type="text" class="form-control" name="alasan_peminjaman" placeholder="Masukkan Jumlah Pinjaman" />
                                </div>

                                <div class="form-group">
                                    <label for="alasan_peminjaman">Alasan Peminjaman</label>
                                    <input type="text" class="form-control" name="alasan_peminjaman" placeholder="Alasan Peminjaman" />
                                </div>


                                <div class="form-group">
                                    <label for="jangka_waktu">Jangka Waktu</label>
                                    <input type="date" class="form-control" id="jangka_waktu" name="jangka_waktu" placeholder="Kota/Tanggal/Bulan/Tahun" />
                                </div>

                                <

                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <input class="btn btn-success" type="submit"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>


@endsection

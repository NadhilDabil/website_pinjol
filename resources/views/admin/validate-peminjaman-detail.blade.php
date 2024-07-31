
@extends('layouts')

@section('content')
<div class="container">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Formulir Data Diri</div>
                </div>
                <form action="{{ route('validate-peminjaman.update', $peminjaman->id) }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                                    <input type="text" class="form-control" name="jumlah_pinjaman" placeholder="Masukkan Jumlah Pinjaman" readonly />

                                </div>

                                <div class="form-group">
                                    <label for="alasan_peminjaman">Alasan Peminjaman</label>
                                    <input type="text" class="form-control" name="alasan_peminjaman" placeholder="Alasan Peminjaman" readonly />

                                </div>

                                <div class="form-group">
                                    <label for="jangka_waktu">Jangka Waktu</label>
                                    <input type="date" class="form-control" name="jangka_waktu"  readonly/>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div>
                                        <input type="checkbox" id="status_sukses" name="status[]" value="sukses" />
                                        <label for="status_sukses">Sukses</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="status_pending" name="status[]" value="pending" />
                                        <label for="status_pending">Pending</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <input class="btn btn-success" type="submit" value="Submit"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

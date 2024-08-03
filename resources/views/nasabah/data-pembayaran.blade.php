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
                <div class="card-header">
                  <h4 class="card-title">Data Peminjaman Anda</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table
                      id="basic-datatables"
                      class="display table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" class="text">Tanggal Meminjam</th>
                          <th scope="col" class="text">Jangka Waktu</th>
                          <th scope="col" class="text">Jumlah Pinjaman</th>
                          <th scope="col" class="text">Status</th>
                          <th scope="col" class="text">Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>


                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>

    <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

      });
    </script>

@endsection



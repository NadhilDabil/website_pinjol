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
                  <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table
                      id="basic-datatables"
                      class="display table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" class="text">Nama Nasabah</th>
                          <th scope="col" class="text">NIK</th>
                          <th scope="col" class="text">Alamat</th>
                          <th scope="col" class="text">No Telephone</th>
                          <th scope="col" class="text">Pekerjaan</th>
                          <th scope="col" class="text">Jenis Kelamin</th>
                          <th scope="col" class="text">Hutang</th>
                          <th scope="col" class="text">Action</th>
                        </tr>
                      </thead>

                      @foreach ($nasabah as $index => $nasabahs)
                      <tbody>
                        <tr>
                          <td class="text">{{$index + 1}}</td>
                          <td class="text">{{$nasabahs->nama_lengkap}}</td>
                          <td class="text">{{$nasabahs->nik}}</td>
                          <td class="text">{{$nasabahs->alamat}}</td>
                          <td class="text">{{$nasabahs->nomor_telepon}}</td>
                          <td class="text">{{$nasabahs->pekerjaan}}</td>
                          <td class="text">{{$nasabahs->jenis_kelamin}}</td>
                          <td class="text">Ambil dari Field Peminjaman</td>
                          <td class="text"><button class="btn btn-info">Info</button></td>
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

    <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

      });
    </script>

@endsection



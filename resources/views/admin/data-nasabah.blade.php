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

                      @foreach ($nasabahs as $index => $nasabah)
                      <tbody>
                        <tr>
                          <td class="text">{{$index + 1}}</td>
                          <td class="text">{{$nasabah->nama_lengkap}}</td>
                          <td class="text">{{$nasabah->nik}}</td>
                          <td class="text">{{$nasabah->alamat}}</td>
                          <td class="text">{{$nasabah->nomor_telepon}}</td>
                          <td class="text">{{$nasabah->pekerjaan}}</td>
                          <td class="text">{{$nasabah->jenis_kelamin}}</td>
                          <td class="text">Ambil dari Field Peminjaman</td>
                          <td class="text"><a class="btn btn-info" href="{{route('form-nasabah.detail', $nasabah->id)}}" >Info</a></td>
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



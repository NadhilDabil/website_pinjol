@auth
    @if (Auth::user()->role === 'nasabah' && ! App\Models\Nasabah::where('user_id', Auth::id())->exists())
        <script>
            window.location.href = "{{ route('form-nasabah') }}";
        </script>
    @endif
@endauth
@extends('layouts')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-primary bubble-shadow-small"
                      >
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Nasabah</p>
                        <h4 class="card-title">{{number_format($totalNasabah)}}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-info bubble-shadow-small"
                      >
                        <i class="fas fa-user-check"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Nasabah Baru</p>
                        <h4 class="card-title">{{number_format($totalNasabahBaru)}}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-success bubble-shadow-small"
                      >
                        <i class="fas fa-luggage-cart"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Tunggakan</p>
                        <h4 class="card-title">0</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-secondary bubble-shadow-small"
                      >
                        <i class="far fa-check-circle"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Lunas</p>
                        <h4 class="card-title">576</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>

</div>

@endsection

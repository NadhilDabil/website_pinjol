<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
</head>

<body>
    <header id="navbar" class="navbar">
        <div class="container">
            <a href="#" class="logo"><img height="55px" src="{{ asset('assets/img/ANDANA1.png') }}"
                    alt=""> ANDANA</a>
            <nav>
                <ul>
                    <li><a href="#home" class="nav-item">Home</a></li>
                    <li><a href="#services" class="nav-item">Services</a></li>
                    <li><a href="#about" class="nav-item">About</a></li>
                    <li><a href="#contact" class="nav-item">Contact</a></li>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="nav-link">
                                    Mulai
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-link">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="page-inner">
                <div class="row">
                    <div class="col-sm-6 col-md-12">
                        <div class="card-body">
                            <div class="row align-items-center ">
                                <!-- Text Column -->
                                <div class="col-md-6 ">
                                    <div class="slogan-container slogan-section">
                                        <label class="slogan-pinjol">Kemudahan Pinjaman di Ujung Jari Anda</label>
                                        <p class="slogan-description">Solusi Keuangan Cepat dan Terpercaya untuk Masa
                                            Depan yang Lebih Cerah</p>
                                        <button class="btn btn-secondary btn-lg">Mulai Sekarang</button>
                                    </div>
                                </div>
                                <!-- Image Column -->
                                <div class="col-md-6 text-center">
                                    <div class="box-container">
                                        <img src="{{ asset('assets/img/gambar11.png') }}" alt="Slogan Image"
                                            class="slogan-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-inner">
            <div class="">
                <div class="main-body">

                </div>

            </div>
            <h1>dwad</h1>
        </div>

    </main>

    <script src="script.js"></script>

</html>

</body>

<script>
    document.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) { // Anda bisa menyesuaikan nilai 50 sesuai kebutuhan
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

</html>

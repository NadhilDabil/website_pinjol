<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
                                <a href="{{ url('/dashboard') }}" class="nav-link">Mulai</a>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
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
                            <div class="row align-items-center">
                                <!-- Text Column -->
                                <div class="col-md-6">
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

        <div class="page-inner my-5">
            <div class="main-head">
                <div class="main-body">
                    <h2 class="text-center">Proses yang Sangat Cepat & Mudah - Keamanan & Kerahasiaan Terjaga</h2>
                    <hr>
                    <div class="d-flex justify-content-center mt-5">
                        <div class="card mx-2  bg-primary text-white" style="width: 30rem;">
                            <div class="card-body">
                                <h4 class="card-title">Pendaftaran Ribet?</h4>
                                <p class="card-text">Tenang Saja, Kami menyediakan Aplikasi dimana pengguna akan
                                    merasakan gampangnnya untuk memulai pendaftaran</p>

                            </div>
                        </div>

                        <div class="card mx-2 bg-warning text-white" style="width: 30rem;">
                            <div class="card-body">
                                <h4 class="card-title">Proses yang Lama?</h4>
                                <p class="card-text">Santai Saja, Aplikasi ini admin sangat gerak cepat supaya para
                                    nasabah tidak menunggu lama</p>

                            </div>
                        </div>

                        <div class="card mx-2 bg-success text-white" style="width: 30rem;">
                            <div class="card-body">
                                <h4 class="card-title">Keamanan Yang Tidak Terjaga?</h4>
                                <p class="card-text">Privacy takut bocor?, Nyans Bro, kami sangat memprioritaskan
                                    keamanan dan juga data nasabah kami</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card-body">
                <h2 class="text-center">Bagian Dari</h2>
                <hr>

                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="box-container">
                            <img width="50%" src="https://unikom.ac.id/img/logo_unikom_kuning.png" alt="Slogan Image"
                                class="slogan-image">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="box-container">
                            <img width="50%"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3rN4kl8oVor95LuMCE7eUylp9jsJMTg035g&s"
                                alt="Slogan Image" class="slogan-image">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="box-container">
                            <img width="50%"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Lambang_Kota_Bandung.svg/1057px-Lambang_Kota_Bandung.svg.png"
                                alt="Slogan Image" class="slogan-image">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="my-5">
            <div class="card-body aboutUs">
                <h2 class="text-center" style="color: white">About Us</h2>
                <hr style="color: white">
                <div class="row align-items-center">
                    <!-- Text Column -->
                    <div class="col-md-5 text-center">
                        <div class="box-container">
                            <img src="{{ asset('assets/img/ANDANA1.png') }}" alt="Slogan Image" class="slogan-image">
                        </div>
                    </div>

                    <div class="col-md-7 mr-2">
                        <div class="aboutus-container slogan-section">
                            <label class="slogan-pinjol"></label>
                            <p class="aboutus-description">ANDANA adalah platform pinjaman online yang didirikan oleh
                                sekelompok mahasiswa dari Universitas Komputer Indonesia dengan tujuan untuk menyediakan
                                solusi keuangan yang mudah dan cepat bagi individu muda yang sudah memenuhi syarat &
                                ketentuan. Kami memahami tantangan keuangan yang sering dihadapi oleh manusia pada
                                umumnya, seperti biaya pendidikan, kebutuhan sehari-hari, dan pengeluaran tak terduga.
                                Oleh karena itu, ANDANA hadir untuk memberikan akses ke pinjaman yang terjangkau dan
                                proses yang transparan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tambahkan jarak dengan margin-top -->
                <div class="row align-items-center g-5 mt-5">
                    <h2 class="text-center" style="color: white">Founder</h2>
                    <hr style="color: white" class="mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('assets/img/founder/Ryan.jpg')}}" alt="Card image cap">
                            <div class="card-body-foto">
                                <h5 class="card-title">Ryansandhya Faiz Wirdiyan</h5>
                                <p class="card-text">"Anda butuh uang? ANDANA solusinya!"</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('assets/img/founder/nadhilfoto.jpg')}}" alt="Card image cap">
                            <div class="card-body-foto">
                                <h5 class="card-title">Nadhil Wirasetya Andariki</h5>
                                <p class="card-text">"Peminjamanmu adalah masadepanku!"</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('assets/img/founder/dapit.jpg')}}" alt="Card image cap">
                            <div class="card-body-foto">
                                <h5 class="card-title">Muhamad David Afkar</h5>
                                <p class="card-text">"ga selalu tentang uang, tapi segalanya butuh uang"</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </main>

    <script src="script.js"></script>

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
</body>

</html>

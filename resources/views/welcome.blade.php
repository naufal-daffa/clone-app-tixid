<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK WIKRAMA BOGOR</title>
    <link rel="icon" href="{{ asset('image/wikrama-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .custom-navbar {
        box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        background: linear-gradient(300deg, white 80%, #1F3984 80%);
        backdrop-filter: blur(50px);
        padding: 10px 20px;
    }

    .custom-footer {
        box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        backdrop-filter: blur(50px);
        padding: 10px 20px;
        width: 81.5%;
        background-color: #051112;
    }

    .school-name {
        color: white;
        font-size: 12px;
        font-weight: 700;
        margin-right: 20px;
    }

    .nav-link {
        color: black;
        font-weight: 700;
        padding: 10px 15px;
        border-radius: 10px;
        transition: all 0.3s;
        text-align: center;
    }

    .nav-link:hover {
        background-color: rgba(31, 57, 132, 0.1);
    }

    .nav-logo {
        width: 55px;
        height: 55px;
        border-radius: 20px;
    }

    .footer-logo {
        width: 70px;
        height: 70px;
        border-radius: 20px;
    }

    @media (max-width: 992px) {
        .custom-navbar {
            background: linear-gradient(310deg, white 70%, #1F3984 70%);
        }

        .navbar-collapse {
            margin-top: 10px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .custom-footer{
            width: 73.5%;
        }

        .nav-link {
            text-align: left;
            padding: 8px 15px;
        }
    }
</style>

<body>
    <!-- Navbar -->
    <div class="container my-3 px-5">
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <img class="nav-logo me-2" src="{{ asset('image/wikrama-logo.png') }}" alt="Logo SMK Wikrama">
                    <div class="school-name">SMK Wikrama<br />Bogor</div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">PPDB 2025-2026</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Jurusan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kegiatan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="container text-light my-5 custom-footer">
        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-">
                <div class="row mt-3">
                    <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <img src="{{ asset('image/wikrama-logo.png') }}" alt="" class="footer-logo me-2"> SMK Wikrama Bogor
                        </h6>
                        <p>
                            Ayo Daftar Sekarang juga, Kami tunggu kedatangannya di SMK Wikrama Bogor
                        </p>
                        <p>
                            Copyright © <?= date('Y') ?> SMK Wikrama Bogor
                        </p>
                    </div>

                    <div class="col-md-3 mt-5 col-lg-3 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Kontak
                        </h6>
                        <p>Hubungi kami di nomor berikut :</p>
                        <ul>
                            <li>0251-8242411</li>
                            <li>082221718035 (Whatsapp)</li>
                        </ul>
                    </div>

                    <div class="col-md-4 mt-5 col-lg-2 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-3">Lokasi</h6>

                        <p>
                            Jl. Raya Wangun No.21, RT.01/RW.06, Sindangsari, Kec. Bogor Tim., Kota Bogor, Jawa Barat 16146
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

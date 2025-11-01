@extends('templates.app')

@section('content')
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle d-flex align-items-center w-100" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fas fa-location-dot me-2"></i>Bogor
        </button>
        <ul class="dropdown-menu w-100">
            <li><a href="" class="dropdown-item">Bogor</a></li>
            <li><a href="" class="dropdown-item">Jakarta</a></li>
            <li><a href="" class="dropdown-item">Bekasi</a></li>
        </ul>
    </div>
    <div id="carouselBasicExample" class="carousel slide carousel-fade w-100" data-mdb-ride="carousel"
        data-mdb-carousel-init>

        <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).webp" class="d-block w-100"
                    alt="Sunset Over the City" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).webp" class="d-block w-100"
                    alt="Canyon at Nigh" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).webp" class="d-block w-100"
                    alt="Cliff Above a Stormy Sea" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Carousel wrapper -->
    <div class="container my-3">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="mt-3">
                <h5>
                    <i class="fa-solid fa-clapperboard"> Sedang Tayang</i>
                </h5>
            </div>
            <div>
                <a href="" class="btn btn-warning rounded-pill">Semua</a>
            </div>
        </div>
        <div class="d-flex my-3 gap-2">
            <a href="" class="btn btn-outline-primary rounded-pill" style="padding: 5px 10px !important"><small>Semua
                    Film</small></a>
            <a href="" class="btn btn-outline-primary rounded-pill"
                style="padding: 5px 10px !important"><small>XXL</small></a>
            <a href="" class="btn btn-outline-primary rounded-pill"
                style="padding: 5px 10px !important"><small>CGV</small></a>
            <a href="" class="btn btn-outline-primary rounded-pill"
                style="padding: 5px 10px !important"><small>cinepolis</small></a>
        </div>
    </div>
    <div class="d-flex justify-content-center gap-4 my-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 13rem">
                    <img style="min-height: 340px"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbU4y3SpTaXgX2H33hQvWY8FR0tQ4pLZMkKg&s"
                        alt="Sunset" class="card-img-top">
                    <div class="card-body" style="padding: 0 !important">
                        <p class="card-text text-center bg-primary py-2">
                            <a href="{{ route('pages.detail') }}" class="text-warning">Beli Tiket</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="width: 13rem">
                    <img style="min-height: 340px"
                        src="https://marketplace.canva.com/EAFbc_Hu3yw/1/0/1131w/canva-hijau-dan-putih-kreatif-film-poster-6kkdqwGkUNY.jpg"
                        alt="Sunset" class="card-img-top">
                    <div class="card-body" style="padding: 0 !important">
                        <p class="card-text text-center bg-primary py-2">
                            <a href="{{ route('pages.detail') }}" class="text-warning">Beli Tiket</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 13rem">
                    <img style="min-height: 340px"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbU4y3SpTaXgX2H33hQvWY8FR0tQ4pLZMkKg&s"
                        alt="Sunset" class="card-img-top">
                    <div class="card-body" style="padding: 0 !important">
                        <p class="card-text text-center bg-primary py-2">
                            <a href="{{ route('pages.detail') }}" class="text-warning">Beli Tiket</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="width: 13rem">
                    <img style="min-height: 340px"
                        src="https://marketplace.canva.com/EAFbc_Hu3yw/1/0/1131w/canva-hijau-dan-putih-kreatif-film-poster-6kkdqwGkUNY.jpg"
                        alt="Sunset" class="card-img-top">
                    <div class="card-body" style="padding: 0 !important">
                        <p class="card-text text-center bg-primary py-2">
                            <a href="{{ route('pages.detail') }}" class="text-warning">Beli Tiket</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 13rem">
                    <img style="min-height: 340px"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbU4y3SpTaXgX2H33hQvWY8FR0tQ4pLZMkKg&s"
                        alt="Sunset" class="card-img-top">
                    <div class="card-body" style="padding: 0 !important">
                        <p class="card-text text-center bg-primary py-2">
                            <a href="{{ route('pages.detail') }}" class="text-warning">Beli Tiket</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="width: 13rem">
                    <img style="min-height: 340px"
                        src="https://marketplace.canva.com/EAFbc_Hu3yw/1/0/1131w/canva-hijau-dan-putih-kreatif-film-poster-6kkdqwGkUNY.jpg"
                        alt="Sunset" class="card-img-top">
                    <div class="card-body" style="padding: 0 !important">
                        <p class="card-text text-center bg-primary py-2">
                            <a href="{{ route('pages.detail') }}" class="text-warning">Beli Tiket</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk mengubah tampilan tombol watchlist saat diklik
        document.addEventListener('DOMContentLoaded', function() {
            const watchlistBtn = document.querySelector('.watchlist-btn');

            watchlistBtn.addEventListener('click', function() {
                if (this.classList.contains('btn-outline-danger')) {
                    this.classList.remove('btn-outline-danger');
                    this.classList.add('btn-danger');
                    this.innerHTML = '<i class="fas fa-check me-2"></i>Dalam Watchlist';
                } else {
                    this.classList.remove('btn-danger');
                    this.classList.add('btn-outline-danger');
                    this.innerHTML = '<i class="fas fa-heart me-2"></i>Tambahkan ke Watchlist';
                }
            });
        });
    </script>
@endsection

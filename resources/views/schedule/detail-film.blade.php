@extends('templates.app')

@section('content')
    <div class="container pt-5">
        <div class="d-flex justify-content-center">
            <div>
                <div class="w-75 d-block m-auto">
                    <div style="width: 150px; height: 200px;">
                        <img src="{{ asset('storage/' . $movie['poster']) }}" alt="" class="w-100">
                    </div>
                </div>
            </div>

            <div class="ms-5 mt-4 ">
                <h5>{{ $movie['title'] }}</h5>
                <table>
                    <tr>
                        <td><b class="text-secondary">Genre</b></td>
                        <td class="px-3"></td>
                        <td>{{ $movie['genre'] }}</td>
                    </tr>
                    <tr>
                        <td><b class="text-secondary">Durasi</b></td>
                        <td class="px-3"></td>
                        <td>{{ $movie['duration'] }}</td>
                    </tr>
                    <tr>
                        <td><b class="text-secondary">Sutradara</b></td>
                        <td class="px-3"></td>
                        <td>{{ $movie['director'] }}</td>
                    </tr>
                    <tr>
                        <td><b class="text-secondary">Rating Usia</b></td>
                        <td class="px-3"></td>
                        <td>
                            @if ($movie['age_rating'] < 13)
                                <span class="badge badge-success">{{ $movie['age_rating'] }}</span>
                            @elseif ($movie['age_rating'] < 21)
                                <span class="badge badge-warning">{{ $movie['age_rating'] }}</span>
                            @else
                                <span class="badge badge-danger">{{ $movie['age_rating'] }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b class="text-secondary">Deskripsi</b></td>
                        <td class="px-3"></td>
                        <td style="max-width: 500px;">"{{ $movie['description'] }}"</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="w-100 row mt-5">
            <div class="col-6 pe-5">
                <div class="d-flex flex-column justify-content-end align-items-end">
                    <div class="d-flex align-items-center">
                        <h3 class="text-warning me-1">5.0</h3>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                    </div>
                    <small>3.894 Vote</small>
                </div>
            </div>
            <div class="col-6 ps-5" style="border-left: 2px solid #c7c7c7">
                <div class="d-flex align-items-center">
                    <div class="fa fa-heart text-danger me-2"></div>
                    <b>Masukan Watchlist</b>
                </div>
                <small>0 Orang</small>
            </div>
            <div class="d-flex w-100 bg-light mt-3">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center w-100" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Bioskop
                    </button>
                    <ul class="dropdown-menu w-100">
                        @foreach ($listCinema['schedules'] as $schedule)
                            <li><a class="dropdown-item" href="?search-cinema={{ $schedule['cinema']['id'] }}">{{ $schedule['cinema']['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center w-100" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sortir
                    </button>
                    @php
                        // ambil nilai tanda ? di url : request()->get('nama-params')
                        if (request()->get('sort-price')) {
                            if (request()->get('sort-price') == 'ASC') {
                                $typePrice = 'DESC';
                            } else {
                                $typePrice = 'ASC';
                            }
                        } else {
                            $typePrice = 'ASC';
                        }

                        if (request()->get('sort-alphabet')) {
                            if (request()->get('sort-alphabet') == 'ASC') {
                                $typeAlphabet = 'DESC';
                            } else {
                                $typeAlphabet = 'ASC';
                            }
                        } else {
                            $typeAlphabet = 'ASC';
                        }
                    @endphp
                    <ul class="dropdown-menu w-100">
                        {{-- mengirimkan query param melalui http method get / href, biasanya untuk search, sort, limit --}}
                        <li><a class="dropdown-item " href="?sort-price={{ $typePrice }}">Harga</a></li>
                        <li><a class="dropdown-item " href="?sort-alphabet={{ $typeAlphabet }}">Alfabet</a></li>
                    </ul>
                </div>
            </div>
            <div class="mb-5">
                @foreach ($movie['schedules'] as $schedule)
                    <div class="w-100 my-3">
                        <div class="d-flex justify-content-between ms-3">
                            <div>
                                <i class="fa-solid fa-building mb-2"></i><b
                                    class="ms-2">{{ $schedule['cinema']['name'] }}</b>
                                </div>
                                <b>Rp. {{ number_format($schedule['price'], 0, ',', '.') }}</b>
                        </div>
                        <br>
                        <small class="ms-3">{{ $schedule['cinema']['location'] }}</small>
                        <div class="d-flex gap-3 ps-3 my-2">
                            @foreach ($schedule['hours'] as $hours)
                                <div class="btn btn-outline-secondary">{{ $hours }}</div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="w-100 p-2 bg-light text-center fixed">
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-ticket"></i> BELI TIKET</a>
            </div>
        </div>
    </div>
    </div>
@endsection

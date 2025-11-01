@extends('templates.app')

@section('content')
    <div class="container my-3">
        <div class="mb-3 text-center fs-4">Seluruh Film Sedang Tayang</div>

        {{-- <form action="{{ route('home.movies.all') }}" method="GET" class="d-flex justify-content-center mb-4" role="search">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control w-50"
                   placeholder="Cari judul, genre, atau sutradara...">
            <button type="submit" class="btn btn-primary ms-2">Cari</button>
        </form> --}}

        <form action="" method="GET" class="d-flex justify-content-center mb-4">
            <input type="text" name="search_movies" class="form-control w-50" placeholder="Cari judul...">
            <button type="submit" class="btn btn-primary ms-2">Cari</button>
        </form>

        <div class="d-flex justify-content-center gap-4 my-3 flex-wrap">
            @forelse ($movies as $item)
                <div class="card" style="width: 13rem; margin : 10px;">
                    <img style="object-fit: cover; height: 300px;"
                         src="{{ asset('storage/' . $item->poster) }}" alt="Poster"
                         class="card-img-top">
                    <div class="card-body" style="padding: 0 !important; height: 50px">
                        <div class="justify-content-center d-flex text-truncate">
                            {{ $item->title }}
                        </div>
                        <p class="card-text text-center shadow py-2">
                            <a href="{{ route('schedules.detail', $item['id']) }}" class="text-warning btn btn-primary">Beli Tiket</a>
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-center mt-3">Tidak ada film yang cocok dengan pencarian "{{ $search }}".</p>
            @endforelse
        </div>
    </div>
@endsection

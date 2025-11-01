@extends('templates.app')

@section('content')
    <div class="container my-3">
        @if (Session::get('error'))
            <div class="alert alert-success">{{ Session::get('failed') }}</div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <h5 class="mt-3">Data Sampah : Film</h5>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Poster</th>
                <th>Judul Film</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @foreach ($movies as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->poster) }}" alt="{{ $item->poster }}" style="width: auto; height:100px;">
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>
                        @if ($item->actived == 1)
                            <div class="badge bg-success">Aktif</div>
                        @else
                            <div class="badge bg-danger">Non-Aktif</div>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center gap-2">

                        <form action="{{ route('admin.movies.restore', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Pulihkan</button>
                        </form>
                        <form action="{{ route('admin.movies.delete_permanent', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTitle">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalDetailBody">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
{{-- @push('script')
    <script>
        function showModal(item) {
            let image = `{{ asset('/storage/${item.poster}') }}`;
            let title = `<h1 class="modal-title fs-5">${item.title}</h1>`;
            let ageBadge = '';
            if (item.age_rating > 21) {
                ageBadge = `<div class="badge badge-danger">21+</div>`;
            } else if (item.age_rating > 13) {
                ageBadge = `<div class="badge badge-warning">13+</div>`;
            } else {
                ageBadge = `<div class="badge badge-success">SU</div>`;
            }

            let content = `
                <img src="${image}" width="120" class="d-block mx-auto my-2">
                <ul>
                    <li>Judul : ${item.title} </li>
                    <li>Durasi : ${item.duration} </li>
                    <li>Genre : ${item.genre} </li>
                    <li>Sutradara : ${item.director} </li>
                    <li>Usia Minimal : ${ageBadge}</li>
                    <li>Sinopsis : ${item.description} </li>
                </ul>
            `;

            let modalTitle = document.getElementById('modalTitle');
            modalTitle.innerHTML = title;

            let modalDetailBody = document.querySelector("#modalDetailBody");
            modalDetailBody.innerHTML = content;

            let modalDetail = document.querySelector("#modalDetail");
            new bootstrap.Modal(modalDetail).show();

            console.log(item)
        }
    </script>
@endpush --}}

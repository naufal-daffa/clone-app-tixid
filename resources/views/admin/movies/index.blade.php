@extends('templates.app')

@section('content')
    <div class="container my-3">
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('admin.movies.export') }}" class="btn btn-secondary">Export (.xlsx)</a>
            <a href="{{ route('admin.movies.create') }}" class="btn btn-success">Tambah Data</a>
            <a href="{{ route('admin.movies.trash') }}" class="btn btn-warning">Lihat Data Sampah</a>
        </div>
        <h5 class="mt-3">Data Film</h5>
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Poster</th>
                    <th>Judul Film</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.movies.datatables') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'imgPoster',
                        name: 'imgPoster',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'activeBadge',
                        name: 'activeBadge',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'buttons',
                        name: 'buttons',
                        orderable: false,
                        searchable: false
                    },
                ]
            })
        });
    </script>
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
@endpush

@extends('templates.app')

@section('content')
    <div class="container mt-5">
        @if (Session::get('failed'))
            <div class="alert alert-success">{{ Session::get('failed') }}</div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="d-flex justify-content-end mt-3 gap-3">
            <a href="{{ route('admin.cinemas.export') }}" class="btn btn-secondary">Export (.xlsx)</a>
            <a href="{{ route('admin.cinemas.create') }}" class="btn btn-success">Tambah Data</a>
            <a href="{{ route('admin.cinemas.trash') }}" class="btn btn-warning">Lihat Data Sampah</a>
        </div>
        <table id="table" class="table table-responsive table-stripped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Bioskop</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
@push('script')
    <script>
        $(function(){
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.cinemas.datatables") }}',
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'location',
                        name: 'location',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'buttons',
                        name: 'buttons',
                        orderable: false,
                        searchable: false
                    },
                ]
            })
        })
    </script>
@endpush

@extends('templates.app')
@push('style')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">     --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css">
@endpush
@section('content')
    <div class="container mt-5">
        @if (Session::get('failed'))
            <div class="alert alert-success">{{ Session::get('failed') }}</div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="d-flex justify-content-end mt-3 gap-3">
            <a href="{{ route('admin.users.export') }}" class="btn btn-secondary">Export (.xlsx)</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah Data</a>
            <a href="{{ route('admin.users.trash') }}" class="btn btn-warning">Lihat Data Sampah</a>
        </div>
        <h4>Data Pengguna (Admin & Staff)</h4>
        <table id="table" class="table table-striped table-responsive mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
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
        $(function() {
                    $('#table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{{ route("admin.users.datatables") }}',
                            columns: [{
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
                                    data: 'email',
                                    name: 'email',
                                    orderable: true,
                                    searchable: true
                                },
                                {
                                    data: 'roleBadge',
                                    name: 'roleBadge',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'buttons',
                                    name: 'buttons',
                                    orderable: false,
                                    searchable: false
                                },
                            ]})
                    })
    </script>
@endpush

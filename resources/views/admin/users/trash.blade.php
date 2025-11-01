@extends('templates.app')

@section('content')
    <div class="container mt-5">
        @if (Session::get('failed'))
            <div class="alert alert-success">{{ Session::get('failed') }}</div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <h5>Data Sampah : Pengguna/Staff</h5>
        <table class="table table-responsive table-bordered mt-3">
            <h4>Data Pengguna (Admin & Staff)</h4>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
            @forelse ($users as $key => $item)
                <tr>
                    <td>{{ $key + 1}}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    @if ($item->role == 'admin')
                        <td>
                            <div class="badge text-bg-info">{{ $item['role'] }}</div>
                        </td>
                    @else
                        <td>
                            <div class="badge text-bg-success">{{ $item['role'] }}</div>
                        </td>
                    @endif
                    <td class="d-flex justify-content-center">
                        <form action="{{ route('admin.users.restore', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-primary">Pulihkan</button>
                        </form>
                        {{-- @method('DELETE') --}}
                        <form action="{{ route('admin.users.delete_permanent', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
            <tr>
                Data Masih Kosong
            </tr>
            @endforelse
        </table>
    </div>
@endsection

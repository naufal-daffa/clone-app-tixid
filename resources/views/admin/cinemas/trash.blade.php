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
            <a href="{{ route('admin.cinemas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <h5>Data Sampah : Bioskop</h5>
        <table class="table table-responsive table-bordered mt-3">
            <tr>
                <th>#</th>
                <th>Nama Bioskop</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
            @forelse ($cinemas as $key => $item)
                <tr>
                    <td>{{ $key + 1}}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['location'] }}</td>
                    <td class="d-flex justify-content-center">
                        <form action="{{ route('admin.cinemas.restore', $item['id']) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Pulihkan</button>
                        </form>
                        {{-- @method('DELETE') --}}
                        <form action="{{ route('admin.cinemas.delete_permanent', $item->id) }}" method="POST">
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

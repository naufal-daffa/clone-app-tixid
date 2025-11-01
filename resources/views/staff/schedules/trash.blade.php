@extends('templates.app')

@section('content')
    <div class="container my-5">
        {{-- @if (Session::get('login'))
            <div class="alert alert-success w-100">{{ Session::get('login') }} <b>Selamat Datang,
                    {{ Auth::user()->name }}</b>
            </div>
        @endif --}}
        @if (Session::get('success'))
            <div class="alert alert-success w-100">{{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger w-100">{{ Session::get('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-end">
            {{-- <button class="btn btn-secondary me-2">Export (.xlsx)</button> --}}
            <a href="{{ route('staff.schedules.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <h5>Data Sampah : Jadwal Penayangan</h5>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Nama Bioskop</th>
                <th>Judul Film</th>
                <th>Aksi</th>
            </tr>
            @forelse ($schedules as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    {{-- <td>{{ $item['cinema_id'] }}</td> --}}
                    {{-- @foreach ($cinemas as $cinema)
                    @if ($item['cinema_id'] == $cinema['id'])
                    <td>{{ $cinema['name'] }}</td>
                    @endif
                    @endforeach --}}
                    <td>{{ $item['cinema']['name'] }}</td>
                    {{-- <td>{{ $item['movie_id'] }}</td> --}}
                    <td>{{ $item['movie']['title'] }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        <form action="{{ route('staff.schedules.restore', $item['id']) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Pulihkan</button>
                        </form>
                        <form action="{{ route('staff.schedules.delete_permanent', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Data Masih Kosong
                    </td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection

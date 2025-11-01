@extends('templates.app')

@section('content')
    <div class="container mt-5">
        @if (Session::get('login'))
            <div class="alert alert-success w-100">{{ Session::get('login') }} <b>Selamat Datang,
                    {{ Auth::user()->name }}</b>
            </div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success w-100">{{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger w-100">{{ Session::get('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('staff.promos.index') }}" class="btn btn-secondary me-2">Kembali</a>
        </div>
        <h5>Data Sampah : Promo</h5>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Kode Promo</th>
                <th>Total Potongan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @foreach ($promos as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->promo_code }}</td>
                    @if ($item->type == 'rupiah')
                        <td>Rp. <?= number_format($item->discount, 0, ',', '.') ?></td>
                    @else
                        <td>{{ $item->discount }}%</td>
                    @endif
                     <td>
                        @if ($item->actived == 1)
                            <div class="badge bg-success">Aktif</div>
                        @else
                            <div class="badge bg-danger">Non-Aktif</div>
                        @endif
                    </td>
                    <td class="d-flex gap-3 justify-content-center">
                        <form action="{{ route('staff.promos.restore', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-primary">Pulihkan</button>
                        </form>
                        <form action="{{ route('staff.promos.delete_permanent', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        {{-- <form action="{{ route('staff.promos.patch', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if ($item->actived == 1)
                                <button type="submit" class="btn btn-warning">Non-Aktifkan Promo</button>
                            @else
                                <button type="submit" class="btn btn-info">Aktifkan Promo</button>
                            @endif
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

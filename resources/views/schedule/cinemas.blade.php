@extends('templates.app')

@section('content')
<div class="container">
    {{-- @if ($cinemas->isEmpty())
        <div class="alert alert-warning text-center my-4">
            Tidak ada bioskop dengan jadwal tayang saat ini.
        </div>
    @else --}}
        @foreach ($cinemas as $cinema)
            <a href="{{ route('cinemas.schedules', $cinema->id) }}" class="text-decoration-none text-dark">
                <div class="card my-3 shadow-sm border-0">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-building me-3"></i>
                            <h5 class="mb-0">{{ $cinema->name }}</h5>
                        </div>
                        <i class="fa-solid fa-arrow-right text-secondary"></i>
                    </div>
                </div>
            </a>
        @endforeach
    {{-- @endif --}}
</div>
@endsection

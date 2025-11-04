@extends('templates.app')
@section('content')
    <div class="container">
        @foreach ($cinemas as $cinema)
        <div class="card my-3">
            <div class="d-flex justify-content-between">
                <div class="card-body d-flex align-items-center">
                    <h5 class="fa-solid fa-star me-3"></h5>
                    <h5>{{ $cinema['name'] }}</h5>
                </div>
                <div class="d-flex align-items-center">
                    <h5 class="fa-solid fa-arrow-right text-secondary me-3"></h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

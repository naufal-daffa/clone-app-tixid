@extends('templates.app')
@section('content')
    <div class="card w-50 d-block mx-auto my-5 p-4">
        <div class="d-flex justify-content-center">
            {{-- <p>{{ $ticket['id'] }}</p> --}}
            <a href="{{ route('tickets.export.pdf', $ticket['id']) }}" class="btn btn-secondary">Bukti Pembayaran</a>
        </div>
        @foreach ($ticket['rows_of_seats'] as $kursi)
            <div class="card-body">
                <div class="w-100">
                    <div class="text-center"><b>{{ $ticket['schedule']['cinema']['name'] }}</b></div>
                    <hr>
                    <b>{{ $ticket['schedule']['movie']['title'] }}</b>
                    <p>Tanggal : {{ \Carbon\Carbon::parse($ticket['ticketPayment']['booked_date'])->format('d F Y') }}</p>
                    <p>Waktu : {{ \Carbon\Carbon::parse($ticket['hour'])->format('H:i') }}</p>
                    <p>Kursi : {{ $kursi }}</p>
                    <p>Harga Tiket : Rp. {{ number_format($ticket['schedule']['price'], 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

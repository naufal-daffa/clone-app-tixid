@extends('templates.app')
@section('content')
    <div class="container card px-3 py-3">
        <div class="card-body">
            <h5 class="text-center">Selesaikan Pembayaran</h5>
            <img src="{{ asset('storage/' . $ticket['ticketPayment']['barcode']) }}" alt="" class="d-block mx-auto mb-4">
            <div class="w-50 d-block mx-auto">
                <div class="d-flex justify-content-between">
                    <p>{{ $ticket['quantity'] }}</p>
                    <p><b>{{ implode(',', $ticket['rows_of_seats']) }}</b></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Harga Tiket</p>
                    <p><b>{{ number_format($ticket['schedule']['price'], 0, ',', '.') }} X {{ $ticket['quantity'] }}</b></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Promo</p>
                    @if ($ticket['promo_id'])
                        <p><b>{{ $ticket['promo']['type'] == 'percent' ? $ticket['promo']['discount'] . '%' :  number_format($ticket['promo']['discount'], 0, ',', '.')}}</b></p>
                    @else
                        <p><b>Promo Tidak Dipilih</b></p>
                    @endif
                </div>
                <div class="d-flex justify-content-between">
                    <p>Biaya Layanan</p>
                    <p><b>Rp. 4.000 X {{ $ticket['quantity'] }}</b></p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Total Biaya</p>
                    @php
                        $price = $ticket['total_price'] + $ticket['service_fee']
                    @endphp
                    <p><b>{{ number_format($price, 0, ',', '.') }}</b></p>
                </div>
                <form action="{{ route('tickets.payment.proof', $ticket['id']) }}" method="post">
                    @php
                        // dd($ticket)
                    @endphp
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Sudah Bayar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

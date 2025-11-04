@extends('templates.app')
@section('content')
    <div class="container card my-5 p=4" style="margin-bottom: 10% !important;">
        <div class="card-body">
            <b>{{ $schedule['cinema']['name'] }}</b><br>
            <b>{{ \Carbon\Carbon::now()->format('d-m-Y') }} || {{ $hour }}</b>

            <div class="d-flex justify-content-center">
                <div class="row w-50">
                    <div class="col-4">
                        <div style="width: 45px; height: 45px; background: #112646"></div>
                        <p>Kursi kosong</p>
                    </div>
                    <div class="col-4">
                        <div style="width: 45px; height: 45px; background: #eaeaea"></div>
                        <p>Kursi Terjual</p>
                    </div>
                    <div class="col-4">
                        <div style="width: 45px; height: 45px; background: #3e85ef"></div>
                        <p>Kursi dipilih</p>
                    </div>
                </div>
            </div>

            @php
                $row = range('A', 'H');
                $col = range('1', '12');
            @endphp

            @foreach ($row as $baris)
                <div class="d-flex justify-content-center my-3">
                    @foreach ($col as $kursi)
                        @if ($kursi == 7)
                            <div style="width: 85px;"></div>
                        @endif
                        <div style="background: #112646; border-radius: 18px; width: 60px; height: 50px; cursor: pointer;"
                            class="text-center d-flex justify-content-center p-3 mx-1 text-white" onclick="selectedSeat('{{ $schedule->price }}', '{{ $baris }}', '{{ $kursi }}', this)" >
                            <span style="font-size: 12px;">{{ $baris }}-{{ $kursi }}</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-100 p-2 bg-light text-center fixed-bottom" id="wrap-btn">
        <b class="text-center p-3">
            Layar Bioskop
        </b>
        <div class="row" style="border: 1px solid #d1d1d1">
            <div class="col-6 text-center" style="border: 1px solid #d1d1d1">
                <b>Total Harga</b>
                <p id="total">Rp. </p>
            </div>
            <div class="col-6 text-center" style="border: 1px solid #d1d1d1">
                <b>Kursi Dipilih</b>
                <p id="selectedSeats">-</p>
            </div>
        </div>
        <a href="javacript:void(0)" class="w-100 text-center fw-bold" id="btn-ticket" style="color: black; cursor: not-allowed;"><i class="fa-solid fa-ticket me-3"></i>RINGKASAN PEMESANAN</a>
    </div>
@endsection
@push('script')
    <script>
        let seats = [];
        function selectedSeat(price, row, col, el){
            let seatItem = row + "-" + col;
            let indexSeat = seats.indexOf(seatItem)
            // let total = document.querySelector("#total")

            if(indexSeat == -1){
                seats.push(seatItem)
                el.style.background = "#3e85ef"
            }else{
                seats.splice(indexSeat, 1)
                el.style.background = "#112646"
            }
            let totalPrice = price * (seats.length)
            let totalPriceEl = document.querySelector('#total')
            totalPriceEl.innerText = "Rp. " + totalPrice

            let selectedSeatEl = document.querySelector('#selectedSeats')

            selectedSeatEl.innerText = seats.join(", ")

        }
    </script>
@endpush

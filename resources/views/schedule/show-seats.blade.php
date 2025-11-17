@extends('templates.app')
@section('content')
    <div class="container card my-5 p=4" style="margin-bottom: 10% !important;">
        <div class="card-body">
            <b>{{ $schedule['cinema']['name'] }}</b> ||
            <b>{{ $schedule['movie']['title'] }}</b><br>
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
                        @php
                            $seat = $baris . '-' . $kursi;
                        @endphp
                        @if (in_array($seat, $seatsFormat))
                            <div style="background: #eaeaea; border-radius: 18px; width: 60px; height: 50px;"
                                class="text-center d-flex justify-content-center p-3 mx-1 text-white">
                                <span style="font-size: 12px;">{{ $baris }}-{{ $kursi }}</span>
                            </div>
                        @else
                            <div style="background: #112646; border-radius: 18px; width: 60px; height: 50px; cursor: pointer;"
                                class="text-center d-flex justify-content-center p-3 mx-1 text-white"
                                onclick="selectedSeat('{{ $schedule->price }}', '{{ $baris }}', '{{ $kursi }}', this)">
                                <span style="font-size: 12px;">{{ $baris }}-{{ $kursi }}</span>
                            </div>
                        @endif
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
            {{-- menyimpan valu yang dibutuhkan untuk aksi ringkasan pemesanan --}}
            <input type="hidden" name="hour" value="{{ $hour }}" id="hour">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}" id="schedule_id">
        </div>
        <div id="btn-order" class="w-100">
            <a href="javascript:void(0)" class="w-100 text-center fw-bold" id="btn-ticket"
                style="color: black; cursor: not-allowed;"><i class="fa-solid fa-ticket me-3"></i>RINGKASAN PEMESANAN</a>
        </div>
    </div>
@endsection
@push('script')
    <script>
        let seats = [];
        let totalPriceData = null

        function selectedSeat(price, row, col, el) {
            let seatItem = row + "-" + col;
            let indexSeat = seats.indexOf(seatItem)
            // let total = document.querySelector("#total")

            if (indexSeat == -1) {
                seats.push(seatItem)
                el.style.background = "#3e85ef"
            } else {
                seats.splice(indexSeat, 1)
                el.style.background = "#112646"
            }
            let totalPrice = price * (seats.length)
            totalPriceData = totalPrice
            let totalPriceEl = document.querySelector('#total')
            totalPriceEl.innerText = "Rp. " + totalPrice

            let selectedSeatEl = document.querySelector('#selectedSeats')

            selectedSeatEl.innerText = seats.join(", ")


            // jika seats lebih dari/sama denga 1 aktifkan order dan tambaha fungsi
            let btnOrder = document.querySelector('#btn-order')
            let teksOrder = document.querySelector('#btn-ticket')
            if (seats.length > 0) {
                btnOrder.style.background = '#112646'
                teksOrder.style.color = 'white'
                btnOrder.style.cursor = 'pointer'
                btnOrder.onclick = createTicketData
            } else {
                btnOrder.style.background = ''
                teksOrder.style.color = ''
                btnOrder.style.cursor = ''
                btnOrder.onclick = null
            }
        }

        function createTicketData() {
            // Asyn js and xml, jika ingin akses data ke serve melaluli js gunakan method. bisa digunakan hanya melalui jquery
            $.ajax({
                url: "{{ route('tickets.store') }}", // Routig akses data
                method: "POST", // http method
                data: {
                    _token: "{{ csrf_token() }}", // csrf token
                    user_id: $('#user_id').val(),
                    schedule_id: $('#schedule_id').val(),
                    rows_of_seats: seats,
                    quantity: seats.length,
                    total_price: totalPriceData,
                    hour: $('#hour').val(),
                },
                success: function(res) {
                    // console.log(response)
                    let dataTicketId = res.data.id
                    window.location.href = `/tickets/${dataTicketId}/order`
                },
                error: function(massage) {
                    console.log(message);
                    alert("Terjadi kesalahan ketika membuat data tiket!")
                }
            })
        }
    </script>
@endpush

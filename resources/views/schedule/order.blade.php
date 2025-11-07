@extends('templates.app')
@section('content')
    <div class="container">
        <div class="card my-3 p-5">
            <div class="card-body">
                <div class="text-center mb-4">Ringkasan Pemesanan</div>
                {{-- <div class="d-flex">
                <div>
                    <img src="{{ asset('storage/' . $ticket['schedule']['movie']['poster']) }}" alt="">
                </div>
                <div>
                    <h4 class="text-warning">{{ $ticket['schedule']['cinema']['name'] }}</h4>
                    <h4 class="text-warning">{{ $ticket['schedule']['movie']['title'] }}</h4>
                    <table>
                        <tr>
                            <td class="text-secondary"><b>Genre :</b></td>
                            <td>{{ $ticket['schedule']['movie']['genre'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary"><b>Durasi :</b></td>
                            <td>{{ $ticket['schedule']['movie']['duration'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary"><b>Sutradara :</b></td>
                            <td>{{ $ticket['schedule']['movie']['director'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-secondary"><b>Rating Usia :</b></td>
                            <td>{{ $ticket['schedule']['movie']['age_rating'] }}</td>
                        </tr>
                    </table>
                </div>
            </div> --}}

            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <div class="w-75 d-block m-auto">
                        <div style="width: 150px; height: 200px;">
                            <img src="{{ asset('storage/' . $ticket['schedule']['movie']['poster']) }}" alt=""
                                class="w-100">
                        </div>
                    </div>
                </div>

                <div class="ms-5 mt-4 ">
                    <h5>{{ $ticket['schedule']['movie']['title'] }} || {{ $ticket['schedule']['cinema']['name'] }}</h5>

                    <table>
                        <tr>
                            <td><b class="text-secondary">Genre</b></td>
                            <td class="px-3"></td>
                            <td>{{ $ticket['schedule']['movie']['genre'] }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Durasi</b></td>
                            <td class="px-3"></td>
                            <td>{{ $ticket['schedule']['movie']['duration'] }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Sutradara</b></td>
                            <td class="px-3"></td>
                            <td>{{ $ticket['schedule']['movie']['director'] }}</td>
                        </tr>
                        <tr>
                            <td><b class="text-secondary">Rating Usia</b></td>
                            <td class="px-3"></td>
                            <td>
                                @if ($ticket['schedule']['movie']['age_rating'] < 13)
                                    <span
                                        class="badge badge-success">{{ $ticket['schedule']['movie']['age_rating'] }}</span>
                                @elseif ($ticket['schedule']['movie']['age_rating'] < 21)
                                    <span
                                        class="badge badge-warning">{{ $ticket['schedule']['movie']['age_rating'] }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $ticket['schedule']['movie']['age_rating'] }}</span>
                                @endif
                            </td>
                        </tr>
                        {{-- <tr>
                        <td><b class="text-secondary">Deskripsi</b></td>
                        <td class="px-3"></td>
                        <td style="max-width: 500px;">"{{ $ticket['schedule']['movie']['description'] }}"</td>
                    </tr> --}}
                    </table>
                </div>
            </div>
            <h4 class="text-secondary mt-5">Nomor Pemesanan : {{ $ticket->id }}</h2>
                <hr>
                <b>Detail Pemesanan</b>
                <table>
                    <tr>
                        <td>{{ count($ticket['rows_of_seats']) }} Tiket: </td>
                        <td><b>{{ implode(',', $ticket['rows_of_seats']) }}</b></td>
                    </tr>
                    <tr>
                        <td>Kursi Reguler: </td>
                        <td><b>Rp. {{ number_format($ticket['schedule']['price'], 0, ',', '.') }} <span
                                    class="text-secondary">x{{ $ticket->quantity }}</span> </b></td>
                    </tr>
                    <tr>
                        <td>Biaya Pelayanan: </td>
                        <td><b>Rp. 4000</b> <span class="text-secondary">x{{ $ticket->quantity }}</span></td>
                    </tr>
                </table>
                <hr>
                <p>Pilih Promo :</p>
                <select name="promo" id="promo" class="form-select">
                    <option value="" selected hidden disabled>Pilih Promo</option>
                    @foreach ($promos as $promo)
                        <option value="{{ $promo->id }}">{{ $promo->promo_code }} -
                            {{ $promo->type == 'percent' ? $promo->discount . '%' : 'Rp.' . number_format($promo->discount, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="fixed-bottom w-100 bg-light p-3 text-center" style="background: #112646; cursor: pointer;"
        onclick="createBarcode('{{ $ticket->id }}')">Bayar Sekarang</div>
@endsection
@push('script')
    <script>
        function createBarcode(ticketId) {
            let promo = $('#promo').val();
            $.ajax({
                url: "{{ route('tickets.barcode', ['ticketId' => ':ticketId']) }}".replace(':ticketId', ticketId),
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    promo_id: promo
                },
                success: function(res) {
                    window.location.href = `/tickets/${ticketId}/payment`;
                },
                error: function(message) {
                    console.log(message);
                    alert('Gagal membuat barcode');
                }
            });
        }
    </script>
@endpush

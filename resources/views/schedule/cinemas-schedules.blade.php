@extends('templates.app')

@section('content')
    <div class="container my-5 card">
        <div class="card-body">
            <i class="fa-solid fa-location-dot me-3"></i>{{ $schedules[0]['cinema']['name'] }}
            <hr>

            @forelse ($schedules as $schedule)
                {{-- <div class="container card my-2">
                    <div class="card-body"> --}}
                        <div class="my-5">
                            {{-- <img src="{{ asset('storage/' . $schedule['movie']['poster']) }}" alt=""> --}}
                            <div class="row">
                                <div class="col-4">
                                    <div style="width: 200px;">
                                        <img src="{{ asset('storage/' . $schedule['movie']['poster']) }}" alt=""
                                            height="300px" class="w-100">
                                    </div>
                                </div>

                                <div class="mt-4 col-8">
                                    <h5>{{ $schedule['movie']['title'] }}</h5>
                                    <table>
                                        <tr>
                                            <td><b class="text-secondary">Genre</b></td>
                                            <td class="px-3"></td>
                                            <td>{{ $schedule['movie']['genre'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b class="text-secondary">Durasi</b></td>
                                            <td class="px-3"></td>
                                            <td>{{ $schedule['movie']['duration'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b class="text-secondary">Sutradara</b></td>
                                            <td class="px-3"></td>
                                            <td>{{ $schedule['movie']['director'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b class="text-secondary">Rating Usia</b></td>
                                            <td class="px-3"></td>
                                            <td>
                                                @if ($schedule['movie']['age_rating'] < 13)
                                                    <span
                                                        class="badge badge-success">{{ $schedule['movie']['age_rating'] }}</span>
                                                @elseif ($schedule['movie']['age_rating'] < 21)
                                                    <span
                                                        class="badge badge-warning">{{ $schedule['movie']['age_rating'] }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-danger">{{ $schedule['movie']['age_rating'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b class="text-secondary">Deskripsi</b></td>
                                            <td class="px-3"></td>
                                            <td style="max-width: 500px;">"{{ $schedule['movie']['description'] }}"</td>
                                        </tr>
                                        {{-- <div id="" class="">
                                        <a href="javacript:void(0)" class="btn btn-primary" id=""><i
                                                class="fa-solid fa-ticket"></i> BELI TIKET</a>
                                    </div> --}}
                                    </table>
                                </div>
                            </div>
                            <div class="w-100 my-3">
                                {{-- <div>
                                    <i class="fa-solid fa-building mb-2"></i><b
                                    class="ms-2">{{ $schedule['cinema']['name'] }}</b>
                                </div> --}}
                                {{-- <small class="ms-3">{{ $schedule['cinema']['location'] }}</small> --}}
                                <div class="d-flex ps-3 mt-4">
                                    <b>Rp. {{ number_format($schedule['price'], 0, ',', '.') }}</b>
                                </div>
                                <div class="d-flex gap-3 ps-3 mt-4">
                                    <br>
                                    @foreach ($schedule['hours'] as $index => $hours)
                                        <div class="btn btn-outline-secondary" style="cursor: pointer;"
                                            onclick="selectedHour('{{ $schedule->id }}', '{{ $index }}', this)">
                                            {{ $hours }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        </div>
                    {{-- </div>
                </div> --}}
            @endforeach
            <div id="wrap-btn" class="w-100 p-2 bg-light text-center fixed-bottom" style="z-index: 3000;">
                <a href="javacript:void(0)" class="btn btn-primary" id="btn-ticket"><i class="fa-solid fa-ticket"></i> BELI
                    TIKET</a>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <script>
        let elementBefore = null;

        function selectedHour(scheduleId, hourId, el) {
            if (elementBefore) {
                elementBefore.style.background = "";
                elementBefore.style.color = "";
                elementBefore.style.borderColor = "";
            }
            el.style.background = '#112546';
            el.style.color = 'white';
            el.style.borderColor = '#112546';
            elementBefore = el;
            wrapBtn = document.querySelector('#wrap-btn');
            btnTicket = document.querySelector('#btn-ticket');

            wrapBtn.classList.remove('bg-light');
            wrapBtn.style.background = 'white';

            let url = "{{ route('schedules.show_seats', ['scheduleId' => ':scheduleId', 'hourId' => ':hourId']) }}"
                .replace(':scheduleId', scheduleId).replace(':hourId', hourId);

            btnTicket.href = url;
            btnTicket.style.color = '#112546';
        }
    </script>
@endpush

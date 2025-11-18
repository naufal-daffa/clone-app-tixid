@extends('templates.app')
@section('content')
    <div class="container card my-5 p-4">
        <div class="card-body">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-pane">
                        Tiket Aktif
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="expired-tab" data-bs-toggle="tab" data-bs-target="#expired-pane">
                        Tiket Kadaluarsa
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="active-pane">
                    <h5 class="mb-3">Tiket Aktif, {{ Auth::user()->name }}</h5>
                    @forelse($ticketActive as $ticket)
                        <a href="{{ route('tickets.fajar', $ticket->id) }}" class="text-decoration-none">
                            <div class="card mb-3 p-3 shadow-sm">
                                <strong> {{ $ticket['schedule']['cinema']['name'] }} :
                                    {{ $ticket->schedule->movie->title }}</strong>
                                <div>Tanggal: {{ $ticket['ticketPayment']['booked_date'] }}</div>
                                <div>Jam: {{ $ticket['hour'] }}</div>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted">Tidak ada tiket aktif.</p>
                    @endforelse
                </div>
                <div class="tab-pane fade" id="expired-pane">
                    <h5 class="mb-3">Tiket Kadaluarsa</h5>

                    @forelse($ticketNonActive as $ticket)
                        <div class="card mb-3 p-3 bg-light">
                            <strong> {{ $ticket['schedule']['cinema']['name'] }} :
                                {{ $ticket->schedule->movie->title }}</strong>
                            <div>Tanggal: {{ $ticket['ticketPayment']['booked_date'] }}</div>
                            <div>Jam: {{ $ticket['hour'] }}</div>
                            <span class="badge bg-danger mt-2">Kadaluarsa</span>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada tiket kadaluarsa.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection

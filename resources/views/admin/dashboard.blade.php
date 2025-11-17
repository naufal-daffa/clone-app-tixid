@extends('templates.app')

@section('content')
    <div class="container mt-5">
        {{-- <h5>Grafik Pembelian Tiket</h5> --}}
        <div class="row">
            <div class="col-6">
                <h5>Data Pembelan Tiket Bulan {{ now()->format('F') }}</h5>
                <canvas id="chartBar"></canvas>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- <script>
        const ctx = document.getElementById('chartBar');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
    <script>
        let labelBar = []
        let dataBar = []

        $(function() {
            $.ajax({
                url: "{{ route('admin.tickets.chart') }}",
                method: "GET",
                success: function(res) {
                    labelBar = res.labels;
                    dataBar = res.data;

                    new Chart($('#chartBar')[0], {
                        type: 'bar',
                        data: {
                            labels: labelBar,
                            datasets: [{
                                label: 'Tiket Terjual',
                                data: dataBar,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(err) {
                    alert('Gagal Memuat Data!');
                }
            });
        });
    </script>
@endpush

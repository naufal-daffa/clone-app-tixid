@extends('templates.app')
@section('content')
    <div class="container p-2">
        <div class="d-flex justify-content-center">
            <div>
                <div class="w-75 d-block m-auto">
                    {{-- <div style="width: 150px; height: 200px;">
                        <img src="{{ asset('storage/' . $ticket['schedule']['movie']['poster']) }}" alt="" class="w-100">
                    </div> --}}
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
                                <span class="badge badge-success">{{ $ticket['schedule']['movie']['age_rating'] }}</span>
                            @elseif ($ticket['schedule']['movie']['age_rating'] < 21)
                                <span class="badge badge-warning">{{ $ticket['schedule']['movie']['age_rating'] }}</span>
                            @else
                                <span class="badge badge-danger">{{ $ticket['schedule']['movie']['age_rating'] }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b class="text-secondary">Deskripsi</b></td>
                        <td class="px-3"></td>
                        <td style="max-width: 500px;">"{{ $ticket['schedule']['movie']['description'] }}"</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

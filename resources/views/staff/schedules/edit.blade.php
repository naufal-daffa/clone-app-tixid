@extends('templates.app')

@section('content')
    <div class="w-75 mx-auto my-5">
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form action="{{ route('staff.schedules.update', $schedule->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label">Bioskop</label>
                <input type="text" class="form-control @error('cinema') is-invalid @enderror" name="cinema"
                    value="{{ $schedule['cinema']['name'] }}">
                @error('cinema')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Film</label>
                <input type="text" name="movie" class="form-control @error('movie') is-invalid @enderror"
                    value="{{ $schedule['movie']['title'] }}">
                @error('movie')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                    value="{{ $schedule['price'] }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jam tayang</label>
                @foreach ($schedule['hours'] as $index => $hours)
                    <div class="d-flex align-items-center mb-2 hour-time">
                        <input type="time" class="form-control" name="hours[]" value="{{ $hours }}">
                        @if ($index > 0)
                            <i class="fa-solid fa-circle-xmark text-danger ms-2 remove-btn"
                                onclick="this.closest('.hour-time').remove()"
                                style="font-size: 1.5rem; cursor: pointer;"></i>
                        @endif
                    </div>
                @endforeach
                <div id="additionalInput"></div>
                @if ($errors->has('hours.*'))
                    <small class="text-danger">{{ $errors->first() }}</small>
                @endif

                <span class="text-primary" onclick="addInput()" style="cursor: pointer">+ Tambah Jam Tayang</span>
            </div>

            <button type="submit" class="btn btn-primary">Kirim data</button>
        </form>
    </div>

    @push('script')
        <script>
            // document.getElementById('addInput').addEventListener('click', function() {
            //     let content = `
    //         <div class="d-flex align-items-center mb-2">
    //             <input type="time" class="form-control" name="hours[]">
    //             <i class="fa-solid fa-circle-xmark text-danger ms-2 remove-btn"
    //                style="font-size: 1.5rem; cursor: pointer;"></i>
    //         </div>`;
            //     document.getElementById('additionalInput').insertAdjacentHTML('beforeend', content);
            // });

            // document.addEventListener('click', function(e) {
            //     if (e.target.classList.contains('remove-btn')) {
            //         e.target.parentElement.remove();
            //     }
            // });
            function addInput() {
                let content = `
            <div class="d-flex align-items-center mb-2 hour-additional">
                    <input type="time" class="form-control" name="hours[]">
                    <i class="fa-solid fa-circle-xmark text-danger ms-2 remove-btn" onclick="this.closest('.hour-additional').remove()"
                       style="font-size: 1.5rem; cursor: pointer;"></i>
                </div>`;
                let wrap = document.getElementById('additionalInput')
                wrap.innerHTML += content
            }

            // function removeInput(e){
            //     if (e.target.classList.contains('remove-btn')) {
            //         e.target.parentElement.remove();
            //     }
            // }
        </script>
    @endpush
@endsection

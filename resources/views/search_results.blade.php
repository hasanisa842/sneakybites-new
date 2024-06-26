@extends('layouts.app')

@section('judul')
    Hasil Pencarian {{ $search }}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="search mb-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-3">
                    <h2 class="fw-bold text-info">Hasil Pencarian "{{ $search }}"</h2>
                </div>

                <div class="col-md-3">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" class="form-control" name="search" placeholder="Cari  Disini...">
                        <button class="d-none" type="submit"></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($searchResults as $destination)
                <div class="col-md-3 mb-3">
                    <div class="col-md-12 shadow-sm">
                        <div class="destination-image"
                            style="background: url({{ asset('storage/images/' . $destination->image) }})"></div>
                        <div class="card-body p-3">
                            <h5 class="card-title fw-bold">{{ $destination->title }}</h5>
                            <p class="card-title fw-bold">{{ $destination->range }}</p>
                            <p class="card-text">{{ substr($destination->description, 0, 70) . '...' }}</p>
                            <a href="{{ route('travel_list_detail', $destination->id) }}"
                                class="btn btn-info fw-bold text-white w-100 mt-3">Lihat
                                Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

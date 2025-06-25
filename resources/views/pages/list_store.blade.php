@extends('layout.template')

@section('title', 'List Store')
@section('navstore', 'active')

@section('container')

<style>
    .card {
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .card:hover img {
        transform: scale(1.05);
    }

    .alert {
        border-radius: 10px;
    }
</style>

<h2 class="fw-bold mb-4">Store Saya</h2>

<a href="/store/create" class="btn btn-primary mb-4">Tambah Store</a>

@if ($stores->isEmpty())
    <div class="alert alert-warning text-center">
        ⚠️ Anda belum memiliki store. <a href="{{ route('store.create') }}" class="fw-bold">Buat Store Sekarang</a>.
    </div>
@else
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($stores as $store)
        <div class="col">
            <div class="card h-100 bg-white">
                <img src="{{ asset('storage/' . $store->logo) }}" class="card-img-top" alt="{{ $store->nama_toko }}">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 30px">{{ $store->nama_toko }}</h5>
                    {{-- <p class="card-text">{{ Str::limit($store->deskripsi, 80, '...') }}</p>
                    <p class="card-text"><strong>Alamat:</strong> {{ $store->alamat }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $store->status }}</p> --}}
                </div>
                <div class="card-footer bg-white border-0 text-end">
                    <a href="/store/home" class="btn btn-success btn-order">Open Store</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- <div class="mt-4 d-flex justify-content-center">
        {{ $stores->links('pagination::bootstrap-5') }}
    </div> --}}
@endif
@endsection

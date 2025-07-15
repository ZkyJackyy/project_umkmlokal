@extends('layout.template')

@section('title', 'Detail Produk')

@section('container')
<style>
    .product-detail-card {
        border-radius: 20px;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .product-img {
        height: 350px;
        object-fit: cover;
        width: 100%;
    }

    .store-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        margin-top: 30px;
    }

    .btn-back {
        border-radius: 10px;
        font-weight: 500;
        margin-bottom: 20px;
    }

    h2, h4 {
        font-weight: bold;
    }
</style>

<div class="container mt-4 mb-5">
    {{-- <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm btn-back">← Kembali</a> --}}

    <div class="card product-detail-card">
        <img src="{{ asset('storage/' . $product->gambar) }}" class="product-img" alt="{{ $product->nama_produk }}">

        <div class="card-body">
            <h2 class="card-title">{{ $product->nama_produk }}</h2>
            <p class="card-text mb-0">Deskripsi: {{ $product->deskripsi }}</p>
            <p class="card-text mb-0">Harga: <strong>Rp {{ number_format($product->harga, 0, ',', '.') }}</strong></p>
            <p class="card-text">Stok: {{ $product->stok }}</p>
            <a href="/orders/create/{{ $product->id }}" class="btn btn-success">Order Sekarang</a>
        </div>
    </div>

    {{-- Info Toko --}}
    <div class="store-info mt-2 p-4 d-flex align-items-center shadow-sm">
        @if($product->store->logo)
            <img src="{{ asset('storage/' . $product->store->logo) }}"
                 alt="Logo Toko"
                 class="rounded-circle"
                 style="height: 100px; width: 100px; object-fit: cover;">
        @endif
    
        <div class="ms-4 flex-grow-1">
            <h4>Toko</h4>
            <p class="mb-0"><strong>Nama Toko:</strong> {{ $product->store->nama_toko }}</p>
            <p class="mb-0"><strong>Deskripsi:</strong> {{ $product->store->deskripsi }}</p>
            <p class="mb-0"><strong>Alamat:</strong> {{ $product->store->alamat }}</p>
            @if ($product->store->status == 'aktif') 
                
            <p><strong>Status:</strong> <span class="text-success"> {{ $product->store->status }}</span></p>
            @endif

            <a href="/stores/{{ $product->store->id }}" class="btn btn-outline-primary btn-sm mt-2">Lihat Store</a>
        </div>
    </div>
    
</div>
@endsection

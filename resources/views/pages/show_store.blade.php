@extends('layout.template')

@section('title', 'Detail Toko')

@section('container')

<style>
    .store-header {
        position: relative;
        text-align: center;
        padding-top: 80px;
        padding-bottom: 40px;
        background: #e3f4fc;
        border-radius: 20px;
        margin-bottom: 60px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .store-logo {
        position: absolute;
        top: -75px;
        left: 50%;
        transform: translateX(-50%);
        height: 150px;
        width: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .product-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background-color: white;
        position: relative;
    }


    .product-img {
        height: 180px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .btn-custom {
        border-radius: 50px;
        font-weight: 600;
    }

    .btn-order {
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        padding: 7px 15px;
    }
</style>

<div class="container mt-5">
    {{-- Banner Toko --}}
    <div class="store-header">
        @if ($store->logo)
            <img src="{{ asset('storage/' . $store->logo) }}" class="store-logo" alt="Logo Toko">
        @endif

        <h2 class="fw-bold mt-4">{{ $store->nama_toko }}</h2>
        <p class="mt-2">{{ $store->deskripsi }}</p>
        <p class="text-muted">{{ $store->alamat }}</p>
    </div>

    {{-- Daftar Produk --}}
    <h3 class="fw-bold mb-4 text-center">Produk dari Toko Ini</h3>
    @if($store->products->count())
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($store->products as $product)
                <div class="col">
                    <div class="product-card h-100">
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top product-img" alt="{{ $product->nama_produk }}">
                        @endif
                        <div class="card-body p-4">
                            <h5 class="card-title mb-2">{{ $product->nama_produk }}</h5>
                            <p class="card-text text-muted mb-0">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            <p class="card-text"><small class="text-muted">Stok: {{ $product->stok }}</small></p>
                            <a href="{{ route('orders.create', $product->id) }}" class="btn btn-success btn-sm btn-order mt-2">Order</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">Toko ini belum memiliki produk.</p>
    @endif
</div>

@endsection

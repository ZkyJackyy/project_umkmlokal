@extends('layout.template')

@section('title', 'Home Store')
@section('navstore', 'active')

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

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
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

    .btn-edit,
    .btn-delete {
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        padding: 5px 15px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
</style>

<div class="container mt-5">
    <div class="store-header">
        @if($store->logo)
            <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo Toko" class="store-logo">
        @else
            <p class="text-muted">Logo belum diunggah</p>
        @endif

        <h2 class="fw-bold mt-4">{{ $store->nama_toko }}</h2>
        <p class="mt-2">{{ $store->deskripsi }}</p>
        <p class="text-muted">{{ $store->alamat }}</p>
        <a href="/product/create" class="btn btn-sm btn-primary btn-custom mt-2">➕ Tambah Produk</a>
    </div>

    {{-- Produk --}}
    @if($store->products->count())
        <h3 class="fw-bold mb-4 text-center">Produk Toko</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($store->products as $product)
                <div class="col">
                    <div class="product-card h-100">
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top product-img" alt="{{ $product->nama_produk }}">
                        @endif
                        <div class="card-body p-4">
                            <h5 class="card-title">{{ $product->nama_produk }}</h5>
                            <p class="card-text text-muted">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            <p class="card-text"><small class="text-muted">Stok: {{ $product->stok }}</small></p>
                            <div class="action-buttons mt-3">
                                <a href="/product/{{ $product->id }}/edit" class="btn btn-outline-primary btn-sm btn-edit">Edit</a>

                                <form action="/product/{{ $product->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center mt-4 text-muted">Belum ada produk di toko ini.</p>
    @endif
</div>

@endsection

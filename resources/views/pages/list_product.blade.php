@extends('layout.template')

@section('title', 'List Product')
@section('navhome', 'active')

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

    .card-title {
        font-weight: bold;
        font-size: 20px;
    }

    .card-text {
        font-size: 14px;
        color: #333;
    }

    .btn-order {
        font-weight: 500;
        border-radius: 50px;
        padding: 8px 20px;
    }

    h1 {
        font-weight: bold;
        font-size: 30px;
        margin-bottom: 30px;
        text-align: center;
    }
</style>

<h1>Daftar Produk</h1>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($products as $product)
    <div class="col">
        <div class="card h-100 bg-white">
            <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->nama_produk }}</h5>
                <p class="card-text">{{ Str::limit($product->deskripsi, 80, '...') }}</p>
                <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                <p class="card-text"><strong>Kategori:</strong> {{ $product->category->category_name }}</p>
                <p class="card-text"><strong>Stok:</strong> {{ $product->stok }}</p>
            </div>
            <div class="card-footer bg-white border-0 text-end">
                <a href="#" class="btn btn-success btn-order">Order</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection

@extends('layout.template')

@section('title', 'List Product')
@section('navhome', 'active')

@section('container')

<style>
    .hero {
        position: relative;
        width: 100%;
        /* width: 100vw; 
        margin-left: calc(-50vw + 50%);
        border-radius: 0; */
        height: 400px;
        margin-bottom: 40px;
        overflow: hidden;
        border-radius: 20px;
    }

    .hero::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/img/header.jpg') no-repeat center center;
        background-size: cover;
        filter: blur(4px) brightness(0.6);
        z-index: 1;
    }

    .hero h1 {
        position: relative;
        z-index: 2;
        color: white;
        font-size: 36px;
        font-weight: bold;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
        text-align: center;
        padding-top: 140px;
    }

    .card {
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    } */

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
        border-radius: 10px;
        padding: 8px 20px;
    }

    h2 {
        font-weight: bold;
        font-size: 30px;
        margin-bottom: 30px;
        text-align: center;
    }
</style>

{{-- Hero Section --}}
<div class="hero">
    <h1>Selamat Datang di Website UMKM Lokal</h1>
</div>

<h2>Daftar Produk</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($products as $product)
    <div class="col">
        <div class="card h-100 bg-white">
            <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama_produk }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->nama_produk }}</h5>
                <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                <p class="card-text"><strong>Stok:</strong> {{ $product->stok }}</p>
            </div>
            <div class="card-footer bg-white border-0 text-end">
                <a href="/orders/create/{{ $product->id }}" class="btn btn-success btn-order">Order</a>
                {{-- <a href="/orders/create/{{ $product->id }}" class="btn btn-info btn-order">Detail</a> --}}
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

@endsection

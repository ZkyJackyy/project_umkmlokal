@extends('layout.template')
@section('title','Checkout')
@section('navDftr', 'active')
@section('container')

<div class="container mt-5">
    <h2>Checkout: {{ $products->nama_produk }}</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $products->id }}">

        <div class="mb-3">
            <label>Harga: <span>Rp {{ number_format($products->harga,0,',','.') }}</span></label>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" max="{{ $products->stok }}" value="1" required>
        </div>

        <div class="mb-3">
            <label>Alamat Pengiriman</label>
            <textarea name="alamat_pengiriman" class="form-control" required>{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea>
        </div>

        <button class="btn btn-success">Order Sekarang</button>
    </form>
</div>

@endsection

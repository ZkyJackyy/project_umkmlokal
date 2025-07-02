@extends('layout.template')
@section('title','Riwayat Order')
@section('navDftr', 'active')
@section('container')

<div class="container mt-5">
    <h2>📋 Riwayat Order</h2>

    @foreach($orders as $order)
    <div class="card mb-3">
        <div class="card-body">
            <h5>
                Order {{ $order->orderItems->first() ? $order->orderItems->first()->product->nama_produk : 'Produk Tidak Diketahui' }} — 
                <span class="badge 
                    @if($order->status == 'pending') bg-warning
                    @elseif($order->status == 'diproses') bg-primary
                    @elseif($order->status == 'dibatalkan') bg-danger
                    @elseif($order->status == 'selesai') bg-success
                    @else bg-secondary
                    @endif
                ">
                    {{ ucfirst($order->status) }}
                </span>
            </h5>
            <p>Tanggal: {{ $order->tanggal_pemesanan->format('d M Y') }}</p>
            <p>Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
            <p>Alamat: {{ $order->alamat_pengiriman }}</p>

            <ul class="list-group mt-3">
                @foreach($order->orderItems as $item)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $item->product->nama_produk }} × {{ $item->jumlah }}</span>
                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </li>
                @endforeach
            </ul>
            @if($order->status === 'diproses')
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="mt-3 text-end">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success btn-sm">Pesanan Diterima</button>
                </form>
            @endif
        </div>
    </div>
    @endforeach
</div>

@endsection

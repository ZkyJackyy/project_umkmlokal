@extends('layout.template')
@section('title', 'Kelola Pesanan')
@section('container')

<div class="container mt-5">
    <h2>📋 Kelola Pesanan Masuk</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nama Pemesan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Produk (Milik Anda)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->tanggal_pemesanan->format('d-m-Y') }}</td>
                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                <td>{{ $order->alamat_pengiriman }}</td>
                <td>
                    <span class="badge 
                        @if($order->status == 'pending') bg-warning 
                        @elseif($order->status == 'diproses') bg-primary 
                        @elseif($order->status == 'dibatalkan') bg-danger 
                        @elseif($order->status == 'selesai') bg-success 
                        {{-- @else bg-secondary --}}
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($order->orderItems->filter(function ($item) {
                            return $item->product && $item->product->store && $item->product->store->user_id == auth()->id();
                        }) as $item)
                            <li>{{ $item->product->nama_produk }} × {{ $item->jumlah }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    @if($order->status == 'pending')
                        <form action="{{ route('orders.accept', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm">Terima</button>
                        </form>

                        <form action="{{ route('orders.reject', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    @else
                        <em>Tidak ada aksi</em>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection

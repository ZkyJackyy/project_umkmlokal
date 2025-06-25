@extends('layout.template')

@section('title', 'Form Add Product')

@section('container')

<style>
    body {
        background: url('/img/regis.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
    }

    h2 {
        font-size: 26px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 25px;
    }

    .btn-primary {
        font-weight: 600;
        padding: 10px;
        font-size: 16px;
        border-radius: 10px;
    }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-8 col-lg-6">
        <div class="glass-card">
            <h2>Tambah Produk Baru</h2>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="store_id" value="{{ $store->id }}">

                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}">
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" min="0" step="0.01" value="{{ old('harga') }}">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" min="0" value="{{ old('stok') }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="1" {{ old('kategori') == 1 ? 'selected' : '' }}>Makanan</option>
                        <option value="2" {{ old('kategori') == 2 ? 'selected' : '' }}>Minuman</option>
                        <option value="3" {{ old('kategori') == 3 ? 'selected' : '' }}>Kerajinan</option>
                        <option value="4" {{ old('kategori') == 4 ? 'selected' : '' }}>Kecantikan</option>
                        <option value="5" {{ old('kategori') == 5 ? 'selected' : '' }}>Fashion</option>
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100" type="submit">Tambah Produk</button>
            </form>
        </div>
    </div>
</div>
@endsection

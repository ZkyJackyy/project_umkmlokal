@extends('layout.template')

@section('title', 'Form Add Product')

@section('navproduct', 'active')


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
    <div class="col-md-12 col-lg-10">
        <div class="glass-card">
            <h2>Tambah Produk Baru</h2>
            <form action="{{ route('update.product', $products->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <input type="hidden" name="store_id" value="{{ $store->id }}"> --}}

                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk',$products->nama_produk) }}">
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi',$products->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" min="0" step="0.01" value="{{ old('harga', $products->harga) }}">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" min="0" value="{{ old('stok', $products->stok) }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" value="{{ old('gambar', $products->gambar) }}">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="1" {{ old('kategori', $products->kategori) == 1 ? 'selected' : '' }}>Makanan</option>
                        <option value="2" {{ old('kategori', $products->kategori) == 2 ? 'selected' : '' }}>Minuman</option>
                        <option value="3" {{ old('kategori', $products->kategori) == 3 ? 'selected' : '' }}>Kerajinan</option>
                        <option value="4" {{ old('kategori', $products->kategori) == 4 ? 'selected' : '' }}>Kecantikan</option>
                        <option value="5" {{ old('kategori', $products->kategori) == 5 ? 'selected' : '' }}>Fashion</option>
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100" type="submit">Ubah Data Produk</button>
            </form>
        </div>
    </div>
</div>
@endsection

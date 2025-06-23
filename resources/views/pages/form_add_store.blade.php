@extends('layout.template')

@section('title', 'Form Add Store')
@section('navstore', 'active')

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
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 25px;
    }

    .btn-primary {
        font-weight: 600;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 10px;
    }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-8 col-lg-6">
        <div class="glass-card">
            <h2>Tambah Store Baru</h2>
            <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Toko -->
                <div class="mb-3">
                    <label for="nama_toko" class="form-label">Nama Toko</label>
                    <input type="text" name="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror" required>
                    @error('nama_toko')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required></textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2" required></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Simpan Store</button>
            </form>
        </div>
    </div>
</div>
@endsection

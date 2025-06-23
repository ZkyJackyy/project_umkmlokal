@extends('layout.template')

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
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .form-label {
        font-weight: 600;
    }

    .btn-success {
        font-weight: bold;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        h2 {
            font-size: 22px !important;
        }
    }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-8 col-lg-6">
        <div class="card glass-card p-4">
            <div class="card-body">
                <h2 class="text-center mb-4 fw-bold" style="font-size: 28px;">Daftar Akun Baru</h2>
                <form action="{{ route('user.regis') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email aktif">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Buat password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Ulangi password">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Pilih Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" id="role">
                            <option value="">-- Pilih Role --</option>
                            <option value="saller">Seller</option>
                            <option value="customer">Customer</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="no_telpon" class="form-label">Nomor Telepon</label>
                        <input type="text" name="no_telpon" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" placeholder="08xxxxxxxxxx">
                        @error('no_telpon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success w-100 mb-3" type="submit">Daftar Sekarang</button>

                    <p class="text-center mt-3">Sudah punya akun? <a href="/login">Login di sini</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

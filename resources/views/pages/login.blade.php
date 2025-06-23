@extends('layout.template')
@section('title', 'Login')
@section('navLogin', 'active')

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

    .btn-primary {
        font-weight: bold;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 24px !important;
        }
    }
</style>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-6 col-lg-5">
        <div class="card glass-card p-4">
            <div class="card-body">
                <h1 class="text-center mb-4 fw-bold" style="font-size: 28px;">Login Akun</h1>
                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Masuk Sekarang</button>
                </form>

                <p class="text-center mt-4 mb-0">Belum punya akun? <a href="/">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
